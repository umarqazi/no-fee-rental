<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/14/20
 * Time: 3:04 PM
 */

namespace App\Forms;

/**
 * Class ReviewForm
 * @package App\Forms
 */
class ReviewForm extends BaseForm {

    /**
     * @var int
     */
    public $for;

    /**
     * @var int
     */
    public $from;

    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $message;

    /**
     * @var bool
     */
    public $token_used;

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'review_for' => $this->for,
            'review_from' => $this->from,
            'token' => $this->token,
            'request_message' => $this->message,
            'is_token_used' => $this->token_used
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules()
    {
        return [
            'review_for' => 'required',
            'review_from' => 'required',
            'request_message' => 'required',
            'token' => 'required|unique:reviews'
        ];
    }
}