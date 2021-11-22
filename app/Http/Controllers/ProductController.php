<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Session;
use DB;
use File;
use Storage;
use Image;
use Carbon\Carbon;
use Response;
use App\Models\Users;



class ProductController extends Controller
{
    public function index()
    {
        $user = Session::get('user');
        $qtdUsers =  Users::all()->count();
        $qtdProducts =  Products::all()->count();
        $products = Products::all();

        return view('products.list-products')->with(compact('user', 'qtdUsers', 'qtdProducts', 'products'));


        
    } 
    public function confirmProduct(Request $request)
    {
        
        $message = [
            'required' => 'Campo Obrigatório',
            'integer' => 'Insira um valor válido',
            'foto.required' => 'Por favor selecione uma imagem',
            'nome.unique' => 'O produto já existe',
            'validade.nullable' => 'Por favor selecione uma data',
            'precoPromo.regex' => 'A Preço Promocional deve ser um número.',
            'numeric' => 'O campo deve ser um número',
            'regex' => 'O formato anterior é inválido.',
            'max' => 'O valor chegou ao limite',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'min' => 'O campo deve ter valor mínimo 1'
        ];


        $request->validate([
            'nome' => 'required|min:3|string|unique:products,nome',
            'descricao' => 'required|min:1|max:500',
            'estoque' => 'required|min:1|max:200000|numeric|integer',
            'preco' => 'required|min:1|max:200000|numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'precoPromo' => 'required|min:1|max:200000|numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',            
            'slug' => 'required',
            'lote' => 'required',
            'validade' => 'nullable|date|required',
            'imgInp' => 'file|required|max:5120|mimes:pdf,jpeg,jpg,png,gif',
        ], $message);
        

        // Define o valor default para a variável que contém o nome da imagem
        $nameFile = null;

        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('imgInp') && $request->file('imgInp')->isValid()) {

             // Nome da imagem
            $name = $_FILES['imgInp'];
            // $nameFile = "{$name}";

            // Recupera a extensão do arquivo
            $extension = $request->imgInp->extension();

            $rand = rand(2,3);
            // Define finalmente o nome
            // $nameFile = "{$name}.{$rand}.{$extension}";

            $nameFile =  time() . "{$extension}";

            

             // Faz o upload:
             // Se tiver funcionado o arquivo foi armazenado em storage/app/public/produtos/nomedinamicoarquivo.extensao
             $upload = $request->imgInp->storeAs('public/produtos', $nameFile);
             
              // Verifica se NÃO deu certo o upload (Redireciona de volta)
           if (!$upload ){
            Session::flash('messageUpload', 'Erro upload foto!');
            Session::flash('alert-class', 'alert-danger');
            // redirect('/products/products-add');
            return redirect()->back();
           }

           $products = new Products;

           // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
           date_default_timezone_set('America/Sao_Paulo');
           // CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
           $dataLocal = date('Y-m-d H:i:s', time());


           $products->nome = request('nome');
           $products->preco = request('preco');
           $products->estoque = request('estoque');
           $products->sku = request('sku');
           $products->link_produto = request('slug');
           $products->foto = $nameFile;
           $products->descricao = request('descricao');
           $products->lote = request('lote');
           $products->precoPromo = request('precoPromo');
           $products->validade = request('validade');
           $products->produtoDisponivel = request('produtoDisponivel') ? 1 : 0;
           $products->produtoVitrine = request('produtoVitrine') ? 1 : 0;
           $products->produtoLancamento = request('produtoLancamento') ? 1 : 0;
           $products->created_at = Carbon::parse($dataLocal);
           $products->updated_at = Carbon::parse($dataLocal);

           $products->save();
           
           Session::flash('message', 'Produto adicionado com sucesso!');
           Session::flash('alert-class', 'alert-success');
           return redirect('list-products');

        }
        
    }

    public function edit($id)
    {
        $products = Products::find($id);
        return view('products.products-edit', compact('products'));
    }

    public function exibeFotoStore($id)
    {
        $prod = Products::find($id);

        $full_path = storage_path().'/app/public/produtos/' . $prod->foto;
        $file = File::get($full_path);
        $type = File::mimeType($full_path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
    
        return $response;
    }

    public function alter(Request $request)
    {
        $message = [
            'required' => 'Campo Obrigatório',
            'integer' => 'Insira um valor válido',
            'foto.required' => 'Por favor selecione uma imagem',
            'nome.unique' => 'O produto já existe',
            'validade.nullable' => 'Por favor selecione uma data',
            'precoPromo.regex' => 'A Preço Promocional deve ser um número.',
            'numeric' => 'O campo deve ser um número',
            'regex' => 'O formato anterior é inválido.',
            'max' => 'O valor chegou ao limite',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'min' => 'O campo deve ter valor mínimo 1'
        ];


        $request->validate([
            'nome' => 'required|min:3|string',
            'descricao' => 'required|min:1|max:500',
            'estoque' => 'required|min:1|max:200000|numeric|integer',
            'preco' => 'required|min:1|max:200000|numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'precoPromo' => 'required|min:1|max:200000|numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',            
            'slug' => 'required',
            'lote' => 'required',
            'validade' => 'nullable|date|required',
            'imgInp' => 'file|max:5120|mimes:pdf,jpeg,jpg,png,gif',
        ], $message);
        

        // Define o valor default para a variável que contém o nome da imagem
        $nameFile = null;

        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('imgInp') && $request->file('imgInp')->isValid()) {

            $extension = $request->imgInp->extension();

            $rand = rand(2,3);
            // Define finalmente o nome
            $name = $_FILES['imgInp']['name'];
            // $nameFile = "{$name}.{$rand}.{$extension}";
            $nameFile =  time() . "." ."{$extension}";

             // Faz o upload:
             // Se tiver funcionado o arquivo foi armazenado em storage/app/public/produtos/nomedinamicoarquivo.extensao
             $upload = $request->imgInp->storeAs('public/produtos', $nameFile);
             
              // Verifica se NÃO deu certo o upload (Redireciona de volta)
           if (!$upload ){
            Session::flash('messageUpload', 'Erro upload foto!');
            Session::flash('alert-class', 'alert-danger');
            // redirect('/products/products-add');
            return redirect()->back();
           }

        }

        // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
        date_default_timezone_set('America/Sao_Paulo');
        // CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
        $dataLocal = date('Y-m-d H:i:s', time());

        $products = Products::find(request('id')); 

        if(!empty($nameFile)){
            //deleta a foto no storage
            $full_path = storage_path().'/app/public/produtos/' . $products->foto;
            File::delete($full_path);    
            $products->foto = $nameFile;
        }
        
        $products->nome = request('nome');
        $products->preco = request('preco');
        $products->estoque = request('estoque');
        $products->sku = request('sku');
        $products->link_produto = request('slug');
        $products->descricao = request('descricao');
        $products->lote = request('lote');
        $products->precoPromo = request('precoPromo');
        $products->validade = request('validade');
        $products->produtoDisponivel = request('produtoDisponivel') ? 1 : 0;
        $products->produtoVitrine = request('produtoVitrine') ? 1 : 0;
        $products->produtoLancamento = request('produtoLancamento') ? 1 : 0;
        $products->created_at = Carbon::parse($dataLocal);
        $products->updated_at = Carbon::parse($dataLocal);

        $products->save();

        
        
        Session::flash('message', 'Produto alterado com sucesso!');
        Session::flash('alert-class', 'alert-success');
        return redirect('list-products');



    }

    public function delete($id){

        $products = Products::find($id);

        if(isset($products)){
            $products->delete();
           
            $full_path = storage_path().'/app/public/produtos/' . $products->foto;

            if(!empty($full_path)){
                File::delete($full_path);
                Session::flash('message', 'Produto deletado com sucesso!');
                Session::flash('alert-class', 'alert-danger');
            }

            
            return redirect('list-products');
        }

    }
}
