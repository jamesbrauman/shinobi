<?php namespace Caffeinated\Shinobi\Rules;

use Closure;

interface RulesContract
{
	/**
	 * @param $permission
	 * @param $user
	 * @param $usee
	 * @return bool
	 */
	public function check($permission, $user, $usee);

	/**
	 * @return array
	 */
	public function rules();

	/**
	 * @param string|string[] $permission
	 * @param callable $rule
	 * @return RulesContract
	 */
	public function add($permission, Closure $rule);
}