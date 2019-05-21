<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed id
 */
class Api extends Model {
	protected $fillable = [
		'name', 'base_url', 'client_id', 'client_secret'
	];

	/*********************************************************
	 * Relationships
	 **********************************************************/

	public function auth_type() {
		return $this->hasOne(ApiAuthType::class);
	}

	public function tokens() {
		return DB::table('api_tokens')
			->join('apis', 'api_tokens.api_id', 'apis.id')
			->where('api.id', $this->id)
			->get();
	}

	public function calls() {
		return $this->hasMany(ApiCall::class);
	}

	/*********************************************************
	 * Methods
	 **********************************************************/
	public function dropExpiredTokens() {
		$this->tokens()->where('expires_at', '>=', today())->delete();
	}

	public function call() {
		$this->calls()->save(new ApiCall());
	}
}
