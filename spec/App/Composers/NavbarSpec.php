<?php namespace spec\App\Composers;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use Orchestra\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Authenticatable;

class NavbarSpec extends ObjectBehavior
{
    function it_is_initializable(Guard $auth)
    {
        $this->beConstructedWith($auth);

        $this->shouldHaveType('App\Composers\Navbar');
    }

    function it_should_bind_user_property(Guard $auth, View $view, Authenticatable $user)
    {
        $auth->user()->shouldBeCalled(1)->willReturn($user);
        $view->with('user', $user)->shouldBeCalled(1)->willReturn(null);

        $this->beConstructedWith($auth);

        $this->compose($view);
    }
}
