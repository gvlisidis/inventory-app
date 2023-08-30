<?php

namespace App\Actions\Box;

use App\Models\Box;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class CreateBoxAction
{
    public function handle(array $data): Box
    {
       return DB::transaction(function () use ($data){
            $box = Box::query()->create($data);
            if (!$box) {
                throw new \Exception('Box not created for account');
            }

            $uri = url("/box/{$box->id}/contents");

            $box->uri = $uri;
            $box->save();
            return $box;
        });
    }
}
