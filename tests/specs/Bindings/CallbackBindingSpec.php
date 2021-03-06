<?php

namespace tests\specs\ssba\JsonDecoder\Bindings;

use ssba\JsonDecoder\Bindings\CallbackBinding;
use ssba\JsonDecoder\JsonDecoder;
use ssba\JsonDecoder\PropertyAccessor;
use PhpSpec\ObjectBehavior;

class CallbackBindingSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('property', function () {
            return 'some callback data';
        });
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CallbackBinding::class);
    }

    public function it_should_return_the_property_name()
    {
        $this->property()->shouldReturn('property');
    }

    public function it_should_execute_the_callback_and_store_the_result(JsonDecoder $jsonDecoder, PropertyAccessor $propertyAccessor)
    {
        $propertyAccessor->set('some callback data')->shouldBeCalled();

        $this->bind($jsonDecoder, [], $propertyAccessor);
    }
}
