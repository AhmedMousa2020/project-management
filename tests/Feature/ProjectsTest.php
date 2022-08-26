<?php

namespace Tests\Feature;

use App\Models\Project;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProjectsTest extends TestCase
{

     /**
     * A  test render projects.
     *
     * @return void
     */

    public function test_projects_screen_can_be_rendered()
    {
        $response = $this->get('/test-projects');

        $response->assertStatus(200);
    }

    /**
     * A  test projects store.
     *
     * @return void
     */
    public function test_store_project()
    {
       // $this->withoutExceptionHandling();
        $project = new Project();
            
        $project->title =  'project management';
        $project->description =  'unittest';
        $project->user_id =  1;
        $project->save();
        $response = $this->get('/test-projects/'.$project->id);
        $response->assertSee('project management');

    }
}
