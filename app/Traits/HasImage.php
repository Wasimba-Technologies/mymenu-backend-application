<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait HasImage
{
    /**
     * @param string $image_type
     * @param Request $request
     * @return mixed
     */
    public function getDataAndSaveImage(string $image_type, Request $request): mixed
    {
        //$org_name = strtolower(explode(' ', $request->input('name'))[0]);
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store(
                $image_type.'/' . $request->header('X-TENANT-ID'), 'public'
            );
            $data['logo'] = $logo;
        }else{
            $logo = $request->file('image')->store(
                $image_type.'/' . $request->header('X-TENANT-ID'), 'public'
            );
            $data['image'] = $logo;
        }
        return $data;
    }

}
