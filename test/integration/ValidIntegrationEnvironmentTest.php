<?php
/**
 * Unit tests determines if WordPress core functions exist
 *
 * @package wordpress-integration-docker
 */

/**
 * This unit tests validates that WP test enviroment exists with WP_UnitTestCase class
 * Then it verifies that WP exists with wp_kses
 *
 * Backup globals must be disabled, otherwise it will cause “mysqli_query(): Couldn’t fetch mysqli” on PHP 5.6
 * https://wordpress.org/support/topic/wp_unittestcaseteardown-causes-mysqli_query-couldnt-fetch-mysqli/
 * @backupGlobals disabled
 */
class ValidIntegrationEnvironmentTest extends \WP_UnitTestCase {
	/**
	 * Test inside_wordpress_environment
	 */
	public function test_inside_wordpress_environment() {
		$inside_wordpress_environment = function_exists('wp_kses');
		$this->assertTrue($inside_wordpress_environment);
	}

	/**
	 * Test verify extensions installed
	 *
	 * Extensions installed: xdebug
	 */
	public function test_php_extensions_installed() {
		if (phpversion() >= 7.3) {
            $this->markTestSkipped(
              'The xdebug extension is not yet available on 7.3.'
            );
        }
		$xdebug_installed = function_exists('xdebug_break');
		$this->assertTrue($xdebug_installed);
	}
}
