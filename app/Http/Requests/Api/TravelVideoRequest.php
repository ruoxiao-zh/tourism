<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class TravelVideoRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'video' => 'required|string|max:255',
            'type'  => [
                'required',
                Rule::in(['travel', 'hotel', 'sports', 'culture']),
            ]
        ];
    }

    public function messages()
    {
        return [
            'video.required' => '视频超链接不能为空',
            'video.string'   => '视频超链接必须为字符串类型',
            'video.max'      => '视频超链接最大字符长度不能超过 100 个字符',
            'type.required'  => '视频类型不能为空',
            'type.in'        => '视频类型只能是 [travel, hotel, sports, culture] 数组中的任一值',
        ];
    }
}
