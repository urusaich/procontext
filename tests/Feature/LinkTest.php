<?php

namespace Tests\Feature;

use App\Models\Link;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

final class LinkTest extends TestCase
{
    use DatabaseMigrations;

    public function test_create(): void
    {
        $this->postJson('/api/links', ['url' => 'disajdsaija'])->assertUnprocessable();
        $response = $this->postJson('/api/links', ['url' => 'https://google.com'])
            ->assertOk()
            ->assertJsonStructure(['code', 'short_url']);

        $this->assertEquals(route(
            'link.go',
            ['model' => $response->json('code')],
        ), $response->json('short_url'));
    }

    public function test_go()
    {
        $code = $this->postJson('/api/links', ['url' => 'https://google.com'])->json('code');
        $model = Link::query()->firstWhere(['code' => $code]);

        $this->assertEquals(0, $model->clicks);
        $this->get("/$code")->assertRedirect('https://google.com');
        $this->assertEquals(1, $model->refresh()->clicks);

        $this->get("/333djd")->assertNotFound();
        $this->get("/api/links/$code/stats")
            ->assertJson([
                'url' => $model->url,
                'code' => $model->code,
                'clicks' => $model->clicks,
                'created_at' => $model->created_at->toIso8601String(),
            ]);
    }
}
