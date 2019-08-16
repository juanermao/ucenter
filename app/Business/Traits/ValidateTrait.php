<?php
namespace App\Business\Traits;

use App\Business\Utils\Unique;
use Illuminate\Support\Facades\Validator;

trait ValidateTrait
{
    public function formValidate($inputs, $rules, $message)
    {
        $validator = Validator::make($inputs, $rules, $message);

        /**
         * 表单字段中文解释
         */
        $attributes = $this->attributes ?? [];

        /**
         * 如果有错误
         * 返回包含错误的第一个字段的第一个错误信息
         */
        if($validator->fails()) {
            $all_errors = $validator->messages()->toArray();
            // print_r($all_errors);exit;
            foreach ($all_errors as $attr => $errors) {
                $error = array_pop($errors);
                $attribute = $attributes[$attr] ?? $attr;
                $placeholder = str_replace('_', ' ', $attr);
                $message = str_replace(":{$placeholder}", $attribute, $error);
                throw new \LogicException($message, Unique::CODE_INVALID_PARAM);
            }
        }

        /**
         * 如果没有错误
         * 返回表单与rules按键求交集的数据
         */
        $data = array_intersect_key($inputs, $rules);
        foreach ($data as $k => $v) {
            if(is_string($v)) {
                $data[$k] = trim($v);
            }
        }

        return $data;
    }



}