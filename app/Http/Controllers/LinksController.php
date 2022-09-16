<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Restaurant;
use App\Http\Controllers\HomeController;

use App\Helpers\ImageUploader;


class LinksController extends Controller
{
    public function LinksExplore()
    {
        if($this->getRestaurantLinks() == "no links available")
        {
            return "no links available";
        }
        $restaurant=HomeController::getRestaurant();
        $links =$this->getRestaurantLinks() == "no links available" ? array() : $this->getRestaurantLinks();

        return response()->view('links.explore',['rastuarant'=>$restaurant,'links'=>$links[0]]);
    }


    public function getRestaurantLinks()
    {
        $links = Link::all();
        if($links == null)
        {
            return "no links available";
        }
        if($links->count() == 0)
        {
            return "no links available";
        }
        return $links;
    }

    public function delete()
    {
        $id = $_GET['id'];
        $item_id = $_GET['item_id'];

        $data =  Link::find($item_id);
        $links = json_decode($data->links);
        unset($links[--$id]);
        $data_links = array_values($links);
        $data->links = $data_links;
        $data->save();
        $res = array(
            'code' =>"200"
        );
        return response()->json($res);
    }
    public function Links(Request $request)
    {
        $links = Link::all();

        if(count($links) == 0)
        {
            $links = new Link();
            $links->id=0;
            $links->features = array(
            'bg_image' => "",
            'bg_color' => "",
            'link_color' => "",
            'frame_color' => "",
            'switch_frame_color' => "",

            'selected' => "",
            );
            $links->links = json_encode(array());

        }
        else
        {
            $links = $links[0];
        }


        return response()->view('links.create',['links' =>$links]);
    }
    public function AddLinksFeature(Request $request)
    {
        $selected = $request->input('selected');

        $bgImagePath = $request->input('image_path') != '' ? $request->input('image_path') : null;
        if ($request->file('bgImage')) {
            $bgImagePath = ImageUploader::handle($request->file('bgImage'), 'links');
        }

        if($selected == "image")
        {
            $selected = $bgImagePath;
        }
        else
        {
            $selected =  $request->input('bgColor');
        }
        if($request->input('id') > 0)
        {

            Link::where('id' ,'>', 0)->update([
                'features->bg_image' =>$bgImagePath,
                'features->bg_color' => $request->input('bgColor'),
                'features->link_color' => $request->input('linkColor'),
                'features->frame_color' => $request->input('frameColor'),
                'features->switch_frame_color' => $request->input('switchFrameColor'),

                'features->selected' =>  $selected
            ]);
        }
        else
        {

            Link::create([
                'features->bg_image' =>$bgImagePath,
                'features->bg_color' => $request->input('bgColor'),
                'features->link_color' => $request->input('linkColor'),
                'features->frame_color' => $request->input('frameColor'),
                'features->switch_frame_color' => $request->input('switchFrameColor'),
                'features->selected' =>  $selected
            ]);
        }
        session()->flash('success', 'تم انشاء الصنف بنجاح');

        return redirect()->to('/links');
    }
    public function AddLinksLink(Request $request)
    {

        $data = array() ;
        $link = array();
        array_push($link ,$request->input('name') );
        array_push($link ,$request->input('url') );

        if($request->input('id') > 0)
        {
            $item =  Link::find($request->input('id'));

            if($item->links == null)
            {
                array_push($data, $link);
            }
            else
            {
                $data = json_decode($item->links);
                array_push($data , $link);
            }
            $item->links = $data;
            $item->save();
        }
        else
        {

            array_push($data, $link);
            Link::create([
                'features->bg_image' =>"",
                'features->bg_color' => "#ffffff",
                'features->link_color' => "#000000",
                'features->frame_color' => "#000000",
                'features->switch_frame_color' => "#000000",
                'features->selected' => "",
                'links'=> json_encode($data)
            ]);
        }
        session()->flash('success', 'تم انشاء الصنف بنجاح');

        return redirect()->to('/links');
    }

    public function SaveQR(Request $request)
    {
        $base64_str = $request->input("image");
        $folderPath = "public/qr"; //path location
        $image_parts = explode(";base64,", $base64_str);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $uniqid = uniqid();
        $file = $folderPath . $uniqid . '.'.$image_type;
        file_put_contents($file, $image_base64);
        return response()->json($file);
    }
}
