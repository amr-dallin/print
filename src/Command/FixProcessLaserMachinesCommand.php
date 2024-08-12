<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use App\Service\ProcessLaserMachinesService;

/**
 * FixProcessLaserMachines command.
 */
class FixProcessLaserMachinesCommand extends Command
{
    protected $defaultTable = 'ProcessLaserMachines';

    public function __construct(public ProcessLaserMachinesService $processLaserMachineService)
    {
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/4/en/console-commands/commands.html#defining-arguments-and-options
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        foreach($this->fetchTable()->find() as $processLaserMachine) {
            if (null !== $processLaserMachine->pouring) {
                switch ($processLaserMachine->print_type) {
                    case PROCESS_LASER_MACHINES_PRINT_TYPE_4_0:
                    case PROCESS_LASER_MACHINES_PRINT_TYPE_4_4:
                    case PROCESS_LASER_MACHINES_PRINT_TYPE_4_1:
                        $processLaserMachine->set('pouring_c', floor($processLaserMachine->pouring / 4));
                        $processLaserMachine->set('pouring_m', floor($processLaserMachine->pouring / 4));
                        $processLaserMachine->set('pouring_y', floor($processLaserMachine->pouring / 4));
                        $processLaserMachine->set('pouring_k', floor($processLaserMachine->pouring / 4));
                        break;
                    default:
                        $processLaserMachine->set('pouring_k', $processLaserMachine->pouring);
                        break;
                }
            }

            if ($this->fetchTable()->save($processLaserMachine)) {
                $io->success($processLaserMachine->id);
                continue;
            }

            $io->error($processLaserMachine->id);
        }
    }
}
