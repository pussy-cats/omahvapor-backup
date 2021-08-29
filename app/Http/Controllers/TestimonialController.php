<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function index()
    {
        $data = [
            'allTestimonials' => Testimonial::paginate(5)
        ];
        return view('testimonial.index', $data);
    }

    public function createTestimonial(Request $request)
    {
        $testimonial = new Testimonial;
        $testimonial->text = $request->text;
        $testimonial->user_id = Auth::user()->id;
        if($testimonial->save()){
            return redirect()->route('home')->with('flash', [
                'card' => 'success',
                'message' => 'Testimoni berhasil disimpan'
            ]);
        }else{
            return redirect()->route('home')->with('flash', [
                'card' => 'failed',
                'message' => 'Testimoni gagal disimpan'
            ]);
        }
    }

    public function deleteTestimonial($id)
    {
        $testimonial = Testimonial::find($id);
        if($testimonial->delete()){
            return redirect()->route('testimonialIndex')->with('flash', [
                'card' => 'success',
                'message' => 'Data Testimoni berhasil dihapus'
            ]);
        }else{
            return redirect()->route('testimonialIndex')->with('flash', [
                'card' => 'failed',
                'message' => 'Data Testimoni gagal dihapus'
            ]);
        }
    }
}
