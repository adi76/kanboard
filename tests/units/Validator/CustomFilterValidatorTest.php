<?php

require_once __DIR__.'/../Base.php';

use Kanboard\Validator\CustomFilterValidator;

class CustomFilterValidatorTest extends Base
{
    public function testValidateCreation()
    {
        $validator = new CustomFilterValidator($this->container);

        // Validate creation
        $r = $validator->validateCreation(array('filter' => 'test', 'name' => 'test', 'user_id' => 1, 'project_id' => 1, 'is_shared' => 0));
        $this->assertTrue($r[0]);

        $r = $validator->validateCreation(array('filter' => str_repeat('a', 101), 'name' => 'test', 'user_id' => 1, 'project_id' => 1, 'is_shared' => 0));
        $this->assertFalse($r[0]);

        $r = $validator->validateCreation(array('name' => 'test', 'user_id' => 1, 'project_id' => 1, 'is_shared' => 0));
        $this->assertFalse($r[0]);
    }

    public function testValidateModification()
    {
        $validator = new CustomFilterValidator($this->container);

        $r = $validator->validateModification(array('id' => 1, 'filter' => 'test', 'name' => 'test', 'user_id' => 1, 'project_id' => 1, 'is_shared' => 0));
        $this->assertTrue($r[0]);

        $r = $validator->validateModification(array('filter' => 'test', 'name' => 'test', 'user_id' => 1, 'project_id' => 1, 'is_shared' => 0));
        $this->assertFalse($r[0]);

        $r = $validator->validateModification(array('id' => 1, 'filter' => str_repeat('a', 101), 'name' => 'test', 'user_id' => 1, 'project_id' => 1, 'is_shared' => 0));
        $this->assertFalse($r[0]);

        $r = $validator->validateModification(array('id' => 1, 'name' => 'test', 'user_id' => 1, 'project_id' => 1, 'is_shared' => 0));
        $this->assertFalse($r[0]);
    }
}
