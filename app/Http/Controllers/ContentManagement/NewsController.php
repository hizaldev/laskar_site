<?php

namespace App\Http\Controllers\ContentManagement;

use App\Http\Controllers\Constant\ConstantController;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCounter;
use App\Models\NewsDocumentation;
use App\Models\WhatsappGroup;
use Carbon\Carbon as CarbonCarbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Jorenvh\Share\ShareFacade;
use Illuminate\Support\Facades\Request as requestip;

class NewsController extends Controller
{
    var $route = 'news';
    var $path_view = 'content_management.news';

    function __construct()
    {
        $this->middleware('permission:content_management_news-list|permission-create|content_management_news-edit|content_management_news-delete', ['only' => ['index','store']]);
        $this->middleware('permission:content_management_news-create', ['only' => ['create','store']]);
        $this->middleware('permission:content_management_news-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:content_management_news-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = News::all();
            return DataTables::of($data)
            ->editColumn('berita', function($item){
                return "".substr($item->berita,3,150)."...";
            })
            ->addColumn('edit', function($item){
                return '
                
                    <a class="btn btn-success btn-sm text-white" href="'.route("$this->route.edit", $item->id).'">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                ';
            })
            ->addColumn('show', function($item){
                return '
                
                    <a class="btn btn-primary btn-sm text-white" href="'.url('read_news/'.$item->slug).'">
                        <i class="fa-solid fa-search"></i>
                    </a>
                ';
            })
            ->addColumn('delete', function($item){
                return '
                    <form action="'. route("$this->route.destroy", $item->id).'" method="POST" id="form" class="form-inline" onSubmit="if (confirm(`Apa anda yakin menghapus data ini? data ini mungkin akan berpengaruh pada data transaksi aplikasi`)) run; return false">
                        '. method_field('delete') . csrf_field().'
                        <button type="submit" class="btn btn-danger btn-sm text-white">
                        <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['edit', 'delete','berita','show'])
            ->make();
        }
        //dd($data);
        ConstantController::logger('-', $this->route.'index', 'list');
        return view("$this->path_view.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = WhatsappGroup::all();
        ConstantController::logger('-', $this->route.'create', 'open form create');
        return view("$this->path_view.create", [
            'group' => $group,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // dd($request->file('file'));
        $this->validate($request, [
            'judul' => 'required|unique:news,judul',
        ]);

        try{
            $data['judul'] = $request->judul;
            $data['berita'] = $request->berita;
            $data['is_show'] = $request->is_show == 'on' ? 'Ya' : 'Tidak';
            $data['is_schedule'] = $request->is_schedule == 'on' ? 'Ya' : 'Tidak';
            $data['is_public'] = $request->is_public == 'on' ? 'Ya' : 'Tidak';
            $data['penulis'] = $request->is_penulis == 'on' ? Auth::user()->name  : 'Admin Humas Laskar PLN';
            $data['slug'] = Str::slug($request->judul, '-');
            if(is_array($request->kategori_berita_id)){
                $str_json = implode(', ',$request->kategori_berita_id);   
                $data['kategori_berita_id'] = $str_json;
             }else{
                $data['kategori_berita_id'] = $request->kategori_berita_id;
             }   
            if($request->is_schedule == 'on'){
                $data['tgl_tayang_mulai'] = $request->tgl_tayang_mulai;
                $data['tgl_tayang_berakhir'] = $request->tgl_tayang_berakhir;
            }else{
                $data['tgl_tayang_mulai'] = Carbon::now();
            }  
            
            $create = News::create($data);
            $url_path = env('DO_URL');
            
            if($request->file('file0') != null){
                $data['news_id'] = $create->id;
                $storeFile = $request->file('file0')->storePublicly(
                        "news/".Carbon::now()->isoFormat('Y').'/'.Carbon::now()->isoFormat('MMMM').'/images',
                        'spaces'
                );
                $data['photos'] = $url_path.'/'.$storeFile;
                $data['tipe'] = 'Images';
                $data['initial'] = 1;
                $file_image = NewsDocumentation::create($data);
            }
            if($request->file('file1') != null){
                $data['news_id'] = $create->id;
                $storeFile = $request->file('file1')->storePublicly(
                        "news/".Carbon::now()->isoFormat('Y').'/'.Carbon::now()->isoFormat('MMMM').'/images',
                        'spaces'
                );
                $data['photos'] = $url_path.'/'.$storeFile;
                $data['initial'] = 2;
                $data['tipe'] = 'Images';
                NewsDocumentation::create($data);
            }
            if($request->file('file2') != null){
                $data['news_id'] = $create->id;
                $storeFile = $request->file('file2')->storePublicly(
                        "news/".Carbon::now()->isoFormat('Y').'/'.Carbon::now()->isoFormat('MMMM').'/images',
                        'spaces'
                );
                $data['photos'] = $url_path.'/'.$storeFile;
                $data['initial'] = 3;
                $data['tipe'] = 'Images';
                NewsDocumentation::create($data);
            }
            if($request->file('file3') != null){
                $data['news_id'] = $create->id;
                $storeFile = $request->file('file3')->storePublicly(
                        "news/".Carbon::now()->isoFormat('Y').'/'.Carbon::now()->isoFormat('MMMM').'/images',
                        'spaces'
                );
                $data['photos'] = $url_path.'/'.$storeFile;
                $data['initial'] = 4;
                $data['tipe'] = 'Images';
                NewsDocumentation::create($data);
            }

            if($request->file('file') != null){
                $data['news_id'] = $create->id;
                $storeFile = $request->file('file')->storePublicly(
                        "news/".Carbon::now()->isoFormat('Y').'/'.Carbon::now()->isoFormat('MMMM').'/file',
                        'spaces'
                );
                $data['photos'] = $url_path.'/'.$storeFile;
                $data['initial'] = 1;
                $data['tipe'] = 'File';
                $file = NewsDocumentation::create($data);
            }

            if($request->sendWa == 'on'){
                // dd('ini muncul'.$request->group_id);
                
                if($request->format_send == 'body'){
                    $message    = "*$request->judul* \n";
                    $message   .= strip_tags($request->berita)." \n";
                }
                if($request->format_send == 'body_only'){
                    $message   .= strip_tags($request->berita)." \n";
                }
                // development
                $message   .= "selengkapnya : https://laskar_site.test/read_news/".Str::slug($request->judul, '-')."/ \n";
                // production
                // $message   .= "selengkapnya https://laskarpln.id/read_news/".Str::slug($request->judul, '-');
                $message   .= "Instagram : https://www.instagram.com/laskar.pln/ \n";
                $message   .= "Website : https://laskarpln.id/ \n";
                $message   .= "Pendaftaran : https://laskarpln.id/register_members \n";
                $tipe = null;
                if($request->lampiran_wa == 'image'){
                    $tipe = 'image';
                    ConstantController::sendMessageWhatssapGroup($message, $request->group_id, $tipe, $file_image->photos);
                }
                if($request->lampiran_wa == 'file'){
                    $tipe = 'file';
                    ConstantController::sendMessageWhatssapGroup($message, $request->group_id, $tipe, $file->photos,Str::slug($request->judul, '-'));
                    ConstantController::sendMessageWhatssapGroup($message, $request->group_id, 'chat');
                }
                if($request->lampiran_wa == 'tanpa_lampiran'){
                    $tipe = 'chat';
                    ConstantController::sendMessageWhatssapGroup($message, $request->group_id, $tipe);
                }

                
               
                
            } 

            
            ConstantController::logger($create->getOriginal(), $this->route.'store', 'insert success');
            ConstantController::successAlert();
        } catch(Exception $e){
            ConstantController::logger($e->getMessage(), $this->route.'store', 'insert error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = News::with('documentation')->findOrFail($id);

        // dd($items->documentation[0]->photos);
        $kategori_berita = explode(", ", $items->kategori_berita_id);
        $group = WhatsappGroup::all();
        ConstantController::logger('-', $this->route.'edit', 'open form edit');
        return view("$this->path_view.edit", [
            'item'=>$items,
            'kategori_berita'=>$kategori_berita,
            'group' => $group,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
        ]);
        $url_path = env('DO_URL');
        try{
            $data['judul'] = $request->judul;
            $data['berita'] = $request->berita;
            $data['is_show'] = $request->is_show == 'on' ? 'Ya' : 'Tidak';
            $data['is_schedule'] = $request->is_schedule == 'on' ? 'Ya' : 'Tidak';
            $data['is_public'] = $request->is_public == 'on' ? 'Ya' : 'Tidak';
            $data['penulis'] = $request->is_penulis == 'on' ? Auth::user()->name  : 'Admin Humas Laskar PLN';
            $data['slug'] = Str::slug($request->judul, '-');
            if(is_array($request->kategori_berita_id)){
                $str_json = implode(', ',$request->kategori_berita_id);   
                $data['kategori_berita_id'] = $str_json;
             }else{
                $data['kategori_berita_id'] = $request->kategori_berita_id;
             }   
            if($request->is_schedule == 'on'){
                $data['tgl_tayang_mulai'] = $request->tgl_tayang_mulai;
                $data['tgl_tayang_berakhir'] = $request->tgl_tayang_berakhir;
            }
            $item = News::findOrFail($id);
            $item->update($data);
            if($request->file('file0') != null){
                // check file ada atau tidak
                $checkPhoto = NewsDocumentation::where('initial', 1)->where('tipe', 'Images')->where('news_id', $id)->first();
                if($checkPhoto){
                    $dataUpdate['deleted_at'] = Carbon::now();
                    $itemPhoto = NewsDocumentation::findOrFail($checkPhoto->id);
                    $itemPhoto->update($dataUpdate);
                }
                $data['news_id'] = $item->id;
                $storeFile = $request->file('file0')->storePublicly(
                        "news/".Carbon::now()->isoFormat('Y').'/'.Carbon::now()->isoFormat('MMMM').'/image',
                        'spaces'
                );
                $data['photos'] = $url_path.'/'.$storeFile;
                $data['initial'] = 1;
                $data['tipe'] = 'Images';
                NewsDocumentation::create($data);
            }
            if($request->file('file1') != null){
                // check file ada atau tidak
                $checkPhoto = NewsDocumentation::where('initial', 2)->where('news_id', $id)->first();
                // dd($checkPhoto->id);
                if($checkPhoto){
                    $dataUpdate['deleted_at'] = Carbon::now();
                    $itemPhoto = NewsDocumentation::findOrFail($checkPhoto->id);
                    $itemPhoto->update($dataUpdate);
                }
                $data['news_id'] = $item->id;
                $storeFile = $request->file('file1')->storePublicly(
                        "news/".Carbon::now()->isoFormat('Y').'/'.Carbon::now()->isoFormat('MMMM').'/image',
                        'spaces'
                );
                $data['photos'] = $url_path.'/'.$storeFile;
                $data['initial'] = 2;
                $data['tipe'] = 'Images';
                NewsDocumentation::create($data);
            }if($request->file('file2') != null){
                // check file ada atau tidak
                $checkPhoto = NewsDocumentation::where('initial', 3)->where('news_id', $id)->first();
                if($checkPhoto){
                    $dataUpdate['deleted_at'] = Carbon::now();
                    $itemPhoto = NewsDocumentation::findOrFail($checkPhoto->id);
                    $itemPhoto->update($dataUpdate);
                }
                $data['news_id'] = $item->id;
                $storeFile = $request->file('file2')->storePublicly(
                        "news/".Carbon::now()->isoFormat('Y').'/'.Carbon::now()->isoFormat('MMMM').'/image',
                        'spaces'
                );
                $data['photos'] = $url_path.'/'.$storeFile;
                $data['initial'] = 3;
                $data['tipe'] = 'Images';
                NewsDocumentation::create($data);
            }if($request->file('file3') != null){
                // check file ada atau tidak
                $checkPhoto = NewsDocumentation::where('initial', 4)->where('news_id', $id)->first();
                if($checkPhoto){
                    $dataUpdate['deleted_at'] = Carbon::now();
                    $itemPhoto = NewsDocumentation::findOrFail($checkPhoto->id);
                    $itemPhoto->update($dataUpdate);
                }
                $data['news_id'] = $item->id;
                $storeFile = $request->file('file3')->storePublicly(
                        "news/".Carbon::now()->isoFormat('Y').'/'.Carbon::now()->isoFormat('MMMM').'/image',
                        'spaces'
                );
                $data['photos'] = $url_path.'/'.$storeFile;
                $data['initial'] = 4;
                $data['tipe'] = 'Images';
                NewsDocumentation::create($data);
            }
            if($request->file('file') != null){
                $checkPhoto = NewsDocumentation::where('initial', 1)->where('tipe', 'File')->where('news_id', $id)->first();
                if($checkPhoto){
                    $dataUpdate['deleted_at'] = Carbon::now();
                    $itemPhoto = NewsDocumentation::findOrFail($checkPhoto->id);
                    $itemPhoto->update($dataUpdate);
                }
                $data['news_id'] = $item->id;
                $storeFile = $request->file('file')->storePublicly(
                        "news/".Carbon::now()->isoFormat('Y').'/'.Carbon::now()->isoFormat('MMMM').'/file',
                        'spaces'
                );
                $data['photos'] = $url_path.'/'.$storeFile;
                $data['initial'] = 1;
                $data['tipe'] = 'File';
                $file = NewsDocumentation::create($data);
            }
            if($request->sendWa == 'on'){
                $message = '';
                if($request->format_send == 'body'){
                    $message    .= "*$request->judul* \n";
                    $message   .= strip_tags($request->berita)." \n";
                }
                if($request->format_send == 'body_only'){
                    $message   .= strip_tags($request->berita)." \n";
                }
                // development
                // $message   .= "selengkapnya : https://laskar_site.test/read_news/".Str::slug($request->judul, '-')."/ \n";
                // production
                $message   .= $request->is_public == 'on' ? "selengkapnya https://laskarpln.id/read_news/".Str::slug($request->judul, '-')."/ \n" : "\n";
                $message   .= "Instagram : https://www.instagram.com/laskar.pln/ \n";
                $message   .= "Website : https://laskarpln.id/ \n";
                $message   .= "Pendaftaran : https://laskarpln.id/register_members \n";
                $tipe = null;
                if($request->lampiran_wa == 'image'){
                    $photos = NewsDocumentation::where('initial', 1)->where('tipe', 'Images')->where('news_id', $id)->first();
                    if($photos){
                        $tipe = 'image';
                        ConstantController::sendMessageWhatssapGroup($message, $request->group_id, $tipe, $photos->photos);
                    }else{
                        ConstantController::logger($item->getOriginal(), $this->route.'update', 'update success');
                        ConstantController::successAlertWithMessage('Berhasil Update data tanpa kirim Foto ke wa');
                        return redirect()->route($this->route.'.index');
                    }
                    
                }
                if($request->lampiran_wa == 'file'){
                    $files = NewsDocumentation::where('initial', 1)->where('tipe', 'File')->where('news_id', $id)->first();
                    if($files){
                        $tipe = 'file';
                        ConstantController::sendMessageWhatssapGroup($message, $request->group_id, $tipe, $files->photos, Str::slug($request->judul, '-'));
                        ConstantController::sendMessageWhatssapGroup($message, $request->group_id, 'chat');
                    }else{
                        ConstantController::logger($item->getOriginal(), $this->route.'update', 'update success');
                        ConstantController::successAlertWithMessage('Berhasil Update data tanpa kirim file ke wa');
                        return redirect()->route($this->route.'.index');
                    }
                    
                }
                if($request->lampiran_wa == 'tanpa_lampiran'){
                    $tipe = 'chat';
                    ConstantController::sendMessageWhatssapGroup($message, $request->group_id, $tipe);
                }
                
            } 
           
            ConstantController::logger($item->getOriginal(), $this->route.'update', 'update success');
            ConstantController::successAlert();
        } catch(Exception $e){
            ConstantController::logger($e->getMessage(), $this->route.'update', 'update error');
            ConstantController::errorAlert($e->getMessage());
        }

        return redirect()->route($this->route.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = News::findOrFail($id);
        $item->delete();
        ConstantController::logger($item->getOriginal(), $this->route.'delete', 'delete success');
        ConstantController::successDeleteAlert();
         return redirect()->route($this->route.'.index');
    }

    public function destroyDocumentation($id)
    {
        $data['deleted_at'] = Carbon::now();
        $item = NewsDocumentation::findOrFail($id);
        $item->update($data);
        ConstantController::logger($item->getOriginal(), $this->route.'delete', 'delete success');
    ConstantController::successDeleteAlert();
         return redirect()->route("$this->route.edit", $item->news_id);
    }

    public function readNews($id)
    {

        // catatan berita yang ditampilkan
        // berita beserta dokumentasi sudah
        // berita yang disajikan merupakan berita yang statusnya show is_show ya, tanggal saat ini berada tanggal range tayang, sudah
        // button share sudah
        // berita yang disajika kan status pulicnnya tidak dan belum login maka 404 sudahh
        // Berita dengan 1 katgeori
        // Most Popular di urut berdasarkan banyak dibaca  terbesar dari news_count id sudah
        // Baca Juga diambil 1 dari masing masing category secara acak
        $now = Carbon::now();

        $items = News::with('documentation')->where('slug', $id)
        ->where('tgl_tayang_mulai','<=', $now->toDateString())
        ->where('tgl_tayang_berakhir','>=', $now->toDateString())
        ->first();

        if($items->is_public == 'Tidak' && !Auth::check() || $items->is_show == 'Tidak'){
            return abort(404);
        }
        // dd($items);
        $kategori_berita =[];
        $shareComponent =[];
        if($items){
            $kategori_berita = explode(", ", $items->kategori_berita_id);
            $shareComponent = ShareFacade::page(
                url('read_news/'.$id),
                $items->judul,
            )
            ->facebook()
            ->twitter()
            ->telegram()
            ->whatsapp();   
        }else{
            return abort(404);
        }

        $bacaJuga = News::with('documentation')->inRandomOrder()->limit(8)->get();

        // start counter news
        $data['news_id'] = $items->id;
        $data['ip_address50'] = requestip::ip();
        $data['viewers'] = Auth::check() ? Auth::user()->name : 'Anonymous';
        NewsCounter::create($data);

        $most_popular = DB::table('news')
        ->select(DB::raw('news.judul, news.slug , count(news_counters.id) as count'))
        ->leftjoin('news_counters', function ($join) {
            $join->on('news.id', '=', 'news_counters.news_id')
            ->whereNull('news_counters.deleted_at');
        })
        ->groupBy('news.id')
        ->whereNull('news.deleted_at')
        ->orderBy('count', 'desc')
        ->take(5)
        ->get();

        $event = News::with('documentation')->where('kategori_berita_id', "LIKE", '%Event%')->inRandomOrder()->limit(5)->get();

        // ConstantController::logger('-', $this->route.'read_news', "Open News $id");
        
        return view("$this->path_view.show", [
            'item'=>$items,
            'kategori_berita'=>$kategori_berita,
            'share' => $shareComponent,
            'most_popular' => $most_popular,
            'baca_juga' => $bacaJuga,
            'event' => $event,
        ]);
    }

}
