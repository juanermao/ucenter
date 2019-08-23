<?php

namespace App\Http\Controllers\Comic;

use App\Business\Models\Comic\ComicModel;
use App\Business\Services\Comic\ComicService;
use App\Business\Services\Comic\ComicTagsService;
use App\Business\Services\Comic\TagService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    /**
     * 获取所有的分类信息
     */
    public function getTags(Request $request)
    {
        $tags = TagService::getTags();
        return $this->echoJson($tags);
    }

    /**
     * 获取当前分类当前页的所有漫画
     */
    public function page(Request $request)
    {
        // TODO 校验tag_id
        $rules = [
            'tag_id' => 'min:1',
        ];

        $message = [
            'tag_id.min' => '分类非法',
        ];
        $inputs = $this->formValidate($request->input(), $rules, $message);
        $res = ComicTagsService::page($inputs['tag_id'] ?? 0);
        return $this->echoJson($res);
    }

    /**
     * 查询当前漫画所对应的所有漫画章节
     */
    public function list(Request $request)
    {
        $rules = [
            'comic_id' => 'required|min:1'
        ];

        $message = [
            'comic_id.required' => 'comic_id 必须',
            'comic_id.min'      => 'comic_id 非法',
        ];
        $inputs = $this->formValidate($request->input(), $rules, $message);
        $res = ComicService::list($inputs['comic_id']);
        print_r($res);
    }

}