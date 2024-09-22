
@extends('components/master')
@section('content')

    <!-- Button trigger modal -->
    <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#veiculoModal">
        adicionar novo carro
    </button>

    <!-- Modal -->
    <div class="modal fade" id="veiculoModal" tabindex="-1" aria-labelledby="novoCarroModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title text-center" id="novoCarroModal">Novo Carro</h5>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('newCar')}}">
                        {{csrf_field()}}
                        <div class="row mb-3">
                            <label for="modelo" class="col-sm-2 col-form-label col-form-label-sm">Modelo</label>
                            <div class="col-sm-10">
                                <input name="modelo" type="text" class="form-control form-control-sm" id="modelo" placeholder="Modelo" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="marca" class="col-sm-2 col-form-label col-form-label-sm">Marca</label>
                            <div class="col-sm-10">
                                <input type="text" name="marca" class="form-control form-control-sm" id="marca" placeholder="Marca" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cor" class="col-sm-2 col-form-label col-form-label-sm">cor</label>
                            <div class="col-sm-5">
                                <input type="text" name="cor" class="form-control form-control-sm" id="cor" placeholder="cor" required>
                            </div>
                            <div class="col-sm-5">
                                <button type="submit" class="btn-primary">Gravar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col col-lg-12">
            <table id="carTables" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>MODELO</th>
                    <th>MARCA</th>
                    <th>COR</th>
                    <th>Operações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td>{{$car->id}}</td>
                        <td>{{$car->modelo}}</td>
                        <td>{{$car->marca}}</td>
                        <td>{{$car->cor}}</td>
                        <td>
                            <!-- SIMULAÇÃO-->
                            <div class="btn-group mr-2" role="group">
                                <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#addSimulacao_{{$car->id}}">criar simulação</button>
                                <div class="modal fade" id="addSimulacao_{{$car->id}}" tabindex="-1" aria-labelledby="simulacao" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content p-5">
                                            <div class="modal-header d-block">
                                                <h5 class="modal-title text-center"> PREENCHA OS DADOS PARA A SIMULAÇÃO DO FINANCIAMENTO DO VEÍCULO</h5>
                                            </div>
                                            <div class="row">

                                                <table class="table table-info table-sm">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Modelo</th>
                                                        <th scope="col">Marca</th>
                                                        <th scope="col">Cor</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">{{$car->id}}</th>
                                                        <td>{{$car->modelo}}</td>
                                                        <td>{{$car->marca}}</td>
                                                        <td>{{$car->cor}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <form class="row" method="POST" action="{{route('finance')}}">
                                                {{csrf_field()}}
                                                <div class="col-md-6">
                                                    <label for="cliNome" class="form-label">Nome</label>
                                                    <input type="text" class="form-control" id="cliNome" name="cliNome" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="sobreNome" class="form-label">Sobre Nome</label>
                                                    <input type="text" class="form-control" id="sobreNome" name="sobreNome" required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="endereco" class="form-label">Endereço</label>
                                                    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="digite o seu endereço" required>
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="cidade" class="form-label">CIDADE</label>
                                                    <input type="text" class="form-control" id="cidade" name="cidade" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="estado" class="form-label">ESTADO</label>
                                                    <select name="estado" id="estado" class="form-select" required>
                                                        <option selected></option>
                                                        <option value="SP">SP</option>
                                                        <option value="RJ">RIO DE JANEIRO</option>
                                                        <option value="MG">MATO GROSSO</option>
                                                        <option value="CA">CEARÁ</option>
                                                        <option value="AS">AMAZONAS</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="cep" class="form-label" >CEP</label>
                                                    <input type="text" class="form-control" id="cep" name="cep" required>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-12">
                                                        <button type="submit" class="btn-primary">Obter simulação</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--EDITAR VEICULO -->
                            <div class="btn-group mr-2" role="group">
                                <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#veiculoModalEdit_{{$car->id}}" >editar</button>
                                <div class="modal fade" id="veiculoModalEdit_{{$car->id}}" tabindex="-1" aria-labelledby="editCarroModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header d-block">
                                                <h5 class="modal-title text-center" id="novoCarroModal">EDITAR VEICULO</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form role="form" method="POST" action="{{route('updateCar',$car->id)}}">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <label for="modelo" class="col-sm-2 col-form-label col-form-label-sm">Modelo</label>
                                                        <div class="col-sm-10">
                                                            <input name="modelo" type="text" class="form-control form-control-sm" id="modelo" value="{{$car->modelo}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="marca" class="col-sm-2 col-form-label col-form-label-sm">Marca</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="marca" class="form-control form-control-sm" id="marca" value="{{$car->marca}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="cor" class="col-sm-2 col-form-label col-form-label-sm">cor</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" name="cor" class="form-control form-control-sm" id="cor" value="{{$car->cor}}" required>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <button type="submit" class="btn-primary">Salvar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- ELIMINAR-->
                            <div class="btn-group" role="group">
                                <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#deleteCarModal_{{$car->id}}">eliminar</button>
                                <div class="modal fade" id="deleteCarModal_{{$car->id}}" tabindex="-1" aria-labelledby="deteleCarModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header d-block">
                                                <h5 class="modal-title text-center" id="novoCarroModal">REMOÇÃO DE CARRO {{$car->id}}</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <span for="texto ">
                                                           <small> Tem a certeza que quer eliminar este carro ?!</small>
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <form role="form" method="POST" action="{{route('deleteCar')}}">
                                                            {{ csrf_field() }}
                                                            @method('DELETE')
                                                            <input type="number" name="id" id="id" value="{{$car->id}}" hidden="true">
                                                            <div class="col-sm-10">
                                                                <button type="submit" class="btn-primary">Eliminar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="row text-center">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('javascript')
    @include('components/dataTablesDependency')
    <script>
        new DataTable('#carTables', {
            columnDefs: [{ width: '25%', targets: 4 }]
        });
    </script>
@endsection

