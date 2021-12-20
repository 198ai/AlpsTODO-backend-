<?php
namespace App\Http\Requests\Api;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
                {
                    return [
                        'id' => ['required,exists:shop_user,id']
                    ];
                }
            case 'POST':
                {
                    return [
                        'name' => ['required', 'max:10', 'unique:users,name'],
                        'password' => ['required', 'max:16', 'min:5'],
                        'email'=>['required', 'max:45', 'unique:users,email'],
                    ];
                }
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
            default:
                {
                    return [

                    ];
                }
        }

    }

    public function messages()
    {
        return [
            'id.required'=>'ユーザ名は必須項目です',
            'id.exists'=>'ユーザは存在していません',
            'name.unique' => 'ユーザはすでに存在しています',
            'name.required' => 'ユーザ名は必須項目です',
            'name.max' => 'ユーザ名の文字数は10以内となっております',
            'password.required' => '暗証番号は必須項目です',
            'password.max' => '暗証番号の文字数は16以内となっております',
            'password.min' => 'パスワードの長さは6文字以上です',
            'email.required' => 'メールアドレスは必須項目です',
            'email.max' => 'メールアドレスの文字数は45以内となっております',
            'email.unique' => 'メールアドレスはすでに存在しています',
        ];


    }

    protected function failedValidation(Validator $validator)
    {
        $error= $validator->errors()->all();
        throw new HttpResponseException($this->fail(400, $error));
    }

    protected function fail(int $code, array $errors) : JsonResponse
    {
        return response()->json(
            [
                'code' => $code,
                'errors' => $errors,
            ]
        );
    }

}
