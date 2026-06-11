<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\ValidatedInput;

final class LinkController extends Controller
{
    public function go(Link $model)
    {
        $model->handleGo();

        return redirect($model->url);
    }

    public function store()
    {
        $input = Validator::make(request()->all(), [
            'url' => ['required', 'url'],
        ])->safe();

        $model = new Link;
        $model->url = (string) $input->string('url');

        do {
            $code = Str::random(6);
        } while(Link::query()->where('code', $code)->exists());

        $model->code = $code;
        $model->save();

        return [
            'code' => $model->code,
            'short_url' => route('link.go', ['model' => $model->code]),
        ];
    }

    public function stats(Link $model) {
        return [
            'url' => $model->url,
            'code' => $model->code,
            'clicks' => $model->clicks,
            'created_at' => $model->created_at->toIso8601String(),
        ];
    }
}
