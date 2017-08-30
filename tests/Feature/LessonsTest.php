<?php

namespace Tests\Feature;

use App\Lesson;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\Feature\ApiTester;


class LessonsTest extends ApiTester
{
    use DatabaseMigrations;
    use WithoutMiddleware;
    
    /** @test */
    public function it_fetches_lessons() 
    {

        $this->times(3)->make(Lesson::class);

        $result = $this->makeApiCall('api/v1/lessons');

        $this->assertEquals(200, $result->statusCode);

    }

    /** @test */

    public function it_fetches_a_single_lesson()
    {
        $this->make(Lesson::class);
        $lesson = $this->makeApiCall('api/v1/lessons/1')->content->data;
        $this->assertObjectHasAttributes($lesson, 'body', 'active', 'title');

    }

    /** @test */

    public function it_404s_if_lesson_not_found()
    {
        $this->make(Lesson::class);

        $response = $this->makeApiCall('api/v1/lessons/x');

        $this->assertEquals(404, $response->statusCode); 
    }

    /** @test */

    public function it_creates_a_new_lesson_given_valid_parameters()
    {
        $response = $this->makeApiCall('api/v1/lessons', 'POST', $this->getStub());

        $this->assertEquals(201, $response->statusCode); 
    }

    /** @test */

    public function it_throws_400_if_a_new_lesson_fails_validation()
    {
        $response = $this->makeApiCall('api/v1/lessons', 'POST');

        $this->assertEquals(400, $response->statusCode); 
    }

    protected function getStub() 
    {
        return [
            'title' => $this->fake->sentence,
            'body' => $this->fake->paragraph,
            'some_bool' => $this->fake->boolean
        ];
    }

}
