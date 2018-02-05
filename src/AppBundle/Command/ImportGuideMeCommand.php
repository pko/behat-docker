<?php

namespace AppBundle\Command;

use AppBundle\Entity\GuideMeAnswer;
use AppBundle\Entity\GuideMeAnswerValue;
use AppBundle\Entity\GuideMeQuestion;
use AppBundle\Manager\GuideMeManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportGuideMeCommand extends Command {
    CONST POUNDERATION = [
        'market' => 10,
        'travelling-company' => 9,
        'activity' => 7,
        'environment' => 8,
        'accommodation' => 6,
    ];

    protected function configure() {
        $this->setName('guideme:import')
            ->setDescription('Import guide me questions')
            ->addArgument(
                'file_name',
                InputArgument::OPTIONAL,
                'Name and path of CSV file',
                dirname(__FILE__) . DIRECTORY_SEPARATOR . 'guideme.csv'
            );
    }

    public function __construct(
        GuideMeManager $guideMeManager,
        EntityManager $doctrine
    ){
        $this->guideMeManager = $guideMeManager;
        $this->doctrine = $doctrine;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('<info>' . date('Y-m-d H:i:s') . ' : begin</info>');
        $fileName = $input->getArgument('file_name');
        if(!is_file($fileName)) {
            $output->writeln('<error>File "' . $fileName . '" do not exists</error>');
            return false;
        }


        // Deletes all rows
        $this->doctrine->getConnection()->executeUpdate("SET foreign_key_checks = 0;");
        $this->doctrine->getConnection()->exec('TRUNCATE TABLE b2csf_guideme_answer_value');
        $this->doctrine->getConnection()->exec('TRUNCATE TABLE b2csf_guideme_answer');
        $this->doctrine->getConnection()->exec('TRUNCATE TABLE b2csf_guideme_question');
        $this->doctrine->getConnection()->executeUpdate("SET foreign_key_checks = 1;");

        $file = fopen($fileName, 'r');

        $questions = fgetcsv($file, 0, ';');
        $guideMeQuestions = [];

        foreach ($questions as $question) {
            if (!empty($question)) {
                $guideMeQuestion = new GuideMeQuestion();
                $guideMeQuestion->setCode($this->slugify($question))
                    ->setLabel($question)
                    ->setPounderation(
                        self::POUNDERATION[$this->slugify($question)]
                    );

                $this->doctrine->persist($guideMeQuestion);
            }
            $guideMeQuestions[] = $guideMeQuestion;
        }

        $answers = fgetcsv($file, 0, ';');
        $guideMeAnswers = [];

        for ($i = 0; $i < count($answers); $i++) {
            $guideMeAnswer = new GuideMeAnswer();
            $guideMeAnswer->setCode($this->slugify($answers[$i]))
                ->setLabel($answers[$i])
                ->setQuestion($guideMeQuestions[$i]);
            if (in_array($answers[$i], ['FR','NL','DE','CH','COM','BE'])) {
               $guideMeAnswer->setVariability('market');
            }
            $this->doctrine->persist($guideMeAnswer);
            $guideMeAnswers[$i] = $guideMeAnswer;
        }

        $max = 22;
        while ($values = fgetcsv($file, 0, ';')) {
            foreach ($values as $value) {
                $guideMeAnswerValue = new GuideMeAnswerValue();
                $guideMeAnswerValue->setOfferCode($value)
                    ->setValue($max)
                    ->setAnswer($guideMeAnswer);

                $this->doctrine->persist($guideMeAnswerValue);
            }
            --$max;
        }

        $this->doctrine->flush();

        return true;
    }

    private function slugify($text)
    {
        $text = preg_replace('/[^A-Za-z0-9-]+/', ' ', $text);
        $shards = explode(' ', $text);

        $slug = '';
        foreach ($shards as $shard)
        {
            if (empty($shard)) {
                continue;
            }

            if(strlen($slug) + strlen($shard) > 55) {
                return $slug;
            }

            $slug = empty($slug) ? $slug : $slug . '-';
            $slug .= strtolower($shard);
        }

        return $slug;
    }

}