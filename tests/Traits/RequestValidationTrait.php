<?php


namespace Tests\Traits;


use Illuminate\Support\Facades\Validator;

trait RequestValidationTrait
{
    protected $_rules;
    protected $_request;

    public function setupValidator($request, $merge_data = []){
        $this->_request = $request;
        if(!empty($merge_data)){
            $this->_request->merge($merge_data);
        }
        $this->_rules = $this->_request->rules();
    }

    /**
     * Validate field
     *
     * @param $field
     * @param $value
     * @return mixed
     */
    protected function validateField($field, $value)
    {
        return $this->getFieldValidator($field, $value)->passes();
    }

    /**
     * Make validator
     *
     * @param $field
     * @param $value
     * @return mixed
     */
    protected function getFieldValidator($field, $value)
    {
        $ruleField = $field;
        $explodedString = explode('.*', $field);
        if (count($explodedString) == 2) {
            $field = $explodedString[0];
        }

        $fields = [$field => $value];

        if (!is_null($this->_request)) {

            $fields += $this->_request->toArray();
        }

        return Validator::make(
            $fields,
            [$ruleField => $this->_rules[$ruleField]]
        );
    }
}
