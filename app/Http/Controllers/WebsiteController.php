<?php

namespace App\Http\Controllers;

use App\Models\Websites;
use App\Respositories\WebsiteRespositoryInterface;
use Illuminate\Http\Request;
// use Illuminate\Contracts\Validation\Validator;
// use Illuminate\Http\Exceptions\HttpResponseException;

class WebsiteController extends Controller {

    protected $websiteRespository;

    public function __construct(WebsiteRespositoryInterface $websiteRespository) {
        $this->websiteRespository = $websiteRespository;
    }
    public function index() {
        return $this->websiteRespository->all();
    }
 
    public function show($id) {
        return $this->websiteRespository->find($id);
    }

    public function store(Request $request) {

        $credentials = $request->validate([
            'name' => ['required', 'unique:websites,name,except,id'],
        ]);


        return  $this->websiteRespository->create($request->all());
    }

    public function update(Request $request, $id) {
        $credentials = $request->validate([
            'name' => ['required', "unique:websites,name,except,$id"],
        ]);

        $websites = $this->websiteRespository->findOrFail($id);
        $this->websiteRespository->update(['id' => $request->id], $request->all());

        return $websites;
    }

    public function delete(Request $request, $id)
    {
        $websites = $this->websiteRespository->findOrFail($id);
        $this->websiteRespository->delete();

        return 204;
    }
}
