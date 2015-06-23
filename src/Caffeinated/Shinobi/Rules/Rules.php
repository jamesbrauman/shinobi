<?php namespace Caffeinated\Shinobi\Rules;

use Closure;

class Rules implements RulesContract
{
	/**
	 * @var array
	 */
	protected $rules = [];

	/**
	 * @param $permission
	 * @param $user
	 * @param $usee
	 * @return bool
	 */
	public function check($permission, $user, $usee)
	{
		if (!array_key_exists($permission, $this->rules)) return false;

		foreach ($this->rules[$permission] as $rule)
			if ($rule($user, $usee) === false) return false;

		return true;
	}

	/**
	 * @return array
	 */
	public function rules()
	{
		return $this->rules;
	}

	/**
	 * @param string|string[] $permission
	 * @param callable $rule
	 * @return RulesContract
	 */
	public function add($permission, Closure $rule)
	{
		if (is_array($permission)) {
			foreach ($permission as $singlePermission) $this->add($singlePermission, $rule);
		} else {
			if (!array_key_exists($permission, $this->rules))
				$this->rules[$permission] = [];

			array_push($this->rules[$permission], $rule);
		}
	}
}