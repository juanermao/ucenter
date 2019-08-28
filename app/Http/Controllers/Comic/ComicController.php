<?php

namespace App\Http\Controllers\Comic;

use App\Business\Models\Comic\Comics;
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
        $res = TagService::getTags();
        return $this->echoJson($res);
    }

    /**
     * 获取漫画的分页
     */
    public function page(Request $request)
    {
        $rules = [
            'tag_id'    => 'min:1',
            'is_finish' => 'min:1',
        ];

        $message = [
            'tag_id.min'    => 'tag_id 非法',
            'is_finish.min' => 'is_finish 非法',
        ];
        $inputs   = $this->formValidate($request->input(), $rules, $message);
        $tagId    = $inputs['tag_id'] ?? 0;
        $isFinish = $inputs['is_finish'] ?? 0;
        $res = ComicService::page($tagId, $isFinish);
        return $this->echoJson($res);
    }

    /**
     * 查询当前漫画的章节分页
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
        return $this->echoJson($res);
    }

    /**
     * 查询某章节的详细内容
     */
    public function detail(Request $request)
    {
        $rules = [
            'comic_list_id' => 'required|min:1'
        ];

        $message = [
            'comic_list_id.required' => '章节id 必须',
        ];
        $inputs = $this->formValidate($request->input(), $rules, $message);
        $res = ComicService::detail($inputs['comic_list_id']);
        return $this->echoJson($res);
    }
}