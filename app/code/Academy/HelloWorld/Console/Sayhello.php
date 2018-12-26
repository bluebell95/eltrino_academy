<?php

namespace Academy\HelloWorld\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use \Academy\Helper\Helper\Data;

class Sayhello extends \Symfony\Component\Console\Command\Command
{

    const NAME = 'name';
    private $helper;
    
    public function __construct(Data $helper)
    {
        parent::__construct();
        $this->helper = $helper;
    }


    protected function configure()
    {
        $options = [
            new InputOption(
                self::NAME,
                null,
                InputOption::VALUE_REQUIRED,
                'Name'
            )
        ];

        $this->setName('example:sayhello')
            ->setDescription('Demo command line')
            ->setDefinition($options);

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($name = $input->getOption(self::NAME)) {

            $output->writeln("Hello " . $this->helper->RandomFunc());

        } else {

            $output->writeln("Hello World");

        }

        return $this;

    }
}
