<?php

/**
 * @param $class
 * @param array $attributes
 * @param null $times
 * @param null $state
 * @return mixed
 *
 * Generate and create factory data.
 */
function create($class, $attributes = [], $times = null, $state = null)
{
    if($state != null)
    {
        createWithState($class, $attributes, $times, $state);
    }
    return factory($class, $times)->create($attributes);
}

/**
 * @param $class
 * @param array $attributes
 * @param null $times
 * @param null $state
 * @return mixed
 *
 * Generate and create factory data.
 */
function createWithState($class, $attributes = [], $times = null, $state = null)
{
    return factory($class, $times)->state($state)->create($attributes);
}

/**
 * @param $class
 * @param array $attributes
 * @param null $times
 * @return mixed
 *
 * Generate factory data without persistence.
 */
function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}

/**
 * Log user in.
 */
function login()
{
    $user = factory('App\User')->create();
    auth()->loginUsingId($user->id);
}

/**
 * Log user using id.
 * @param $id
 */
function loginAs($id)
{
    auth()->loginUsingId($id);
}
