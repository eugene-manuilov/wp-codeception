<?php

// +----------------------------------------------------------------------+
// | Copyright 2015 10up Inc                                              |
// +----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify |
// | it under the terms of the GNU General Public License, version 2, as  |
// | published by the Free Software Foundation.                           |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// |                                                                      |
// | You should have received a copy of the GNU General Public License    |
// | along with this program; if not, write to the Free Software          |
// | Foundation, Inc., 51 Franklin St, Fifth Floor, Boston,               |
// | MA 02110-1301 USA                                                    |
// +----------------------------------------------------------------------+

namespace WPCC;

use Symfony\Component\Console\Application;
use WPCC\Component\Console\Input\ArgvInput;

// do nothing if WP_CLI is not available
if ( ! class_exists( '\WP_CLI_Command' ) ) {
	return;
}

/**
 * Performs Codeception tests.
 *
 * @since 1.0.0
 * @category WPCC
 */
class CLI extends \WP_CLI_Command {

	/**
	 * Runs Codeception tests.
	 *
	 * ### OPTIONS
	 * 
	 * <suite>
	 * : The suite name to run. There are three types of suites available to
	 * use: unit, functional and acceptance, but currently only acceptance tests
	 * are supported.
	 *
	 * <test>
	 * : The test name to run.
	 *
	 * <steps>
	 * : Determines whether to show test steps in output or not.
	 *
	 * <debug>
	 * : Determines whether to show debug and scenario output or not.
	 *
	 * ### EXAMPLE
	 *
	 *     wp codeception run
	 *     wp codeception run --steps
	 *     wp codeception run --debug
	 *
	 * @synopsis [<suite>] [<test>] [--steps] [--debug]
	 *
	 * @since 1.0.0
	 * 
	 * @access public
	 * @param array $args Unassociated array of arguments passed to this command.
	 * @param array $assoc_args Associated array of arguments passed to this command.
	 */
	public function run( $args, $assoc_args ) {
		$app = new Application( 'Codeception', \Codeception\Codecept::VERSION );
		$app->add( new \Codeception\Command\Run( 'run' ) );
		$app->run( new ArgvInput() );
	}

	/**
	 * Creates default config, tests directory and sample suites for current
	 * project. Use this command to start building a test suite.
	 *
	 * By default it will create 3 suites acceptance, functional, and unit. To
	 * customize run this command with --customize option.
	 *
	 * ### OPTIONS
	 *
	 * <customize>
	 * : Sets manually actors and suite names during setup.
	 *
	 * <namespace>
	 * : Creates tests with provided namespace for actor classes and helpers.
	 *
	 * <actor>
	 * : Sets actor name to have Test{NAME} actor in tests.
	 *
	 * <path>
	 * : Sets path to a project, where tests should be placed.
	 * 
	 * ### EXAMPLE
	 *
	 *     wp codeception bootstrap
	 *     wp codeception bootstrap --customize
	 *     wp codeception bootstrap --namespace="Frontend\Tests"
	 *     wp codeception bootstrap --actor=Tester
	 *     wp codeception bootstrap path/to/the/project --customize
	 *
	 * @synopsis [<path>] [--customize] [--namespace=<namespace>] [--actor=<actor>]
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @param array $args Unassociated arguments passed to the command.
	 * @param array $assoc_args Associated arguments passed to the command.
	 */
	public function bootstrap( $args, $assoc_args ) {
		$app = new Application( 'Codeception', \Codeception\Codecept::VERSION );
		$app->add( new \Codeception\Command\Build( 'build' ) );
		$app->add( new \Codeception\Command\Bootstrap( 'bootstrap' ) );
		$app->run( new ArgvInput() );
	}
	
}