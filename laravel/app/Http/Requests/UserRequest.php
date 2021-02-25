<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

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
        // ゲストユーザーログイン時に、ユーザー名とメールアドレスを変更できないよう対策
        if(Auth::id() == config('user.guest_user_id')) {
            return [
                'profile_image' => 'file|mimes:jpeg,png,jpg,bmb|max:2048',
                'self_introduction' => 'string|max:200|nullable',
                'wake_up_time' => 'required|date_format:"H:i"',
            ];
        } else {
            return [
                'name' => 'required|string|max:15|' . Rule::unique('users')->ignore(Auth::id()),
                'email' => 'required|string|email|max:255|' . Rule::unique('users')->ignore(Auth::id()),
                'profile_image' => 'file|mimes:jpeg,png,jpg,bmb', // |max:2048
                'self_introduction' => 'string|max:200|nullable',
                'wake_up_time' => 'required|date_format:"H:i"',
            ];
        }
    }

    public function attributes()
    {
        return [
            'name' => 'username',
            'email' => 'email',
            'password' => 'password',
            'profile_image' => 'profile_image',
            'self_introduction' => 'introduction',
            'wake_up_time' => 'wakeup_time',

        ];
    }

    public function userParams()
    {
        $validated = parent::validated();

        if(isset($validated['profile_image'])) {
            ### S3バケットに画像をアップロード ###

            // S3へアップロード開始
            $image = $validated['profile_image'];

            $image_path = time() . '.' . $image->getClientOriginalName();
            $target_path = public_path('/images/profile/');
            $image->move($target_path, $image_path);
            $validated['profile_image'] = '/images/profile/' . $image_path;

//            $disk = Storage::disk('s3');
//            // バケットの`image/profile`フォルダへアップロード
//            $path = $disk->putFile('images/profile', $image, 'public');
//            // アップロードした画像のフルパスを取得
//            $validated['profile_image'] = $disk->url($path);
        }

        return $validated;
    }
}
