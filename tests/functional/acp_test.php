<?php
/**
 *
 * Thanks for posts extension. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, rxu, www.phpbbguru.net
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace boardtools\cronstatus\tests\functional;

/**
 * @group functional
 */
class acp_test extends \phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('boardtools/cronstatus');
	}

	public function test_acp_module()
	{
		$this->login();
		$this->admin_login();

		$this->add_lang_ext('boardtools/cronstatus', ['cronstatus', 'info_acp_cronstatus']);

		$crawler = self::request('GET', "adm/index.php?sid={$this->sid}&i=-boardtools-cronstatus-acp-cronstatus_module&mode=config");
		$this->assertContainsLang('CRON_STATUS_READY_TASKS', $crawler->filter('tbody > tr')->eq(0)->text());
		$this->assertGreaterThanOrEqual(12, $crawler->filter('tbody > tr')->count());
	}
}
