<?php

declare(strict_types=1);

 /**
 * Flextype - Hybrid Content Management System with the freedom of a headless CMS 
 * and with the full functionality of a traditional CMS!
 * 
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

namespace Flextype\Console\Commands\Entries;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class EntriesUpdateCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('entries:update');
        $this->setDescription('Update entry.');
        $this->addArgument('id', InputArgument::REQUIRED, 'Unique identifier of the entry.');
        $this->addArgument('data', InputArgument::OPTIONAL, 'Data to update for the entry.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $data = $input->getArgument('data') ? serializers()->json()->decode($input->getArgument('data')) : [];

        if (entries()->update($input->getArgument('id'), $data)) {
            $io->success('Entry ' . $input->getArgument('id') . ' updated.');
            return Command::SUCCESS;
        } else {
            $io->error('Entry ' . $input->getArgument('id') . ' wasn\'t updated.');
            return Command::FAILURE;
        }
    }
}