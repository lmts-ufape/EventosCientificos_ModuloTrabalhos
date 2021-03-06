@extends('layouts.app')

@section('content')

<div class="container"  style="position: relative; top: 80px;">

    {{-- titulo da página --}}
    <div class="row justify-content-center titulo-detalhes">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-10">
                    <h1>Meus Eventos</h1>
                </div>
                <div class="col-sm-2">
                    <a href="{{route('evento.criar')}}" class="btn btn-primary">Novo Evento</a>
                </div>
            </div>
        </div>
    </div>
    @if(session('message'))
        <div class="row">
            <div class="col-md-12" style="margin-top: 5px;">
                <div class="alert alert-success">
                    <p>{{session('message')}}</p>
                </div>
            </div>
        </div>
    @endif
    <div class="row cards-eventos-index">
        @foreach ($eventos as $evento)
            @if ($evento->deletado == false)
                @can('isCoordenador', $evento)
                    <div class="card" style="width: 16rem;">
                        @if(isset($evento->fotoEvento))
                            <img class="img-card" src="{{asset('storage/eventos/'.$evento->id.'/logo.png')}}" class="card-img-top" alt="...">
                        @else
                            <img class="img-card" src="{{asset('img/colorscheme.png')}}" class="card-img-top" alt="...">
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="card-title">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                {{$evento->nome}}
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="btn-group dropright dropdown-options">

                                                    <a id="options" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{-- <div onmouseout="this.children[0].src='{{ asset('/img/icons/ellipsis-v-solid.svg') }}';" onmousemove="this.children[0].src='{{ asset('/img/icons/ellipsis-v-solid-hover.svg')}}';">
                                                            <img src="{{asset('img/icons/ellipsis-v-solid.svg')}}" style="width:8px">

                                                        </div> --}}
                                                        <a  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fas fa-cog "></i></a>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a href="{{ route('coord.detalhesEvento', ['eventoId' => $evento->id]) }}" class="dropdown-item">
                                                            <img src="{{asset('img/icons/eye-regular.svg')}}" class="icon-card" alt="">
                                                            Detalhes
                                                        </a>
                                                        {{-- <a href="{{route('evento.editar',$evento->id)}}" class="dropdown-item">
                                                            <img src="{{asset('img/icons/edit-regular.svg')}}" class="icon-card" alt="">
                                                            Editar
                                                        </a> --}}
                                                        <form id="formExcluirEvento{{$evento->id}}" method="POST" action="{{route('evento.deletar',$evento->id)}}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalExcluirEvento{{$evento->id}}">
                                                                <img src="{{asset('img/icons/trash-alt-regular.svg')}}" class="icon-card" alt="">
                                                                Deletar
                                                            </a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </h5>
                                </div>
                            </div>
                            <div>
                                <p class="card-text">
                                    <img src="{{ asset('/img/icons/calendar.png') }}" alt="" width="20px;" style="position: relative; top: -2px;"> {{date('d/m/Y',strtotime($evento->dataInicio))}} - {{date('d/m/Y',strtotime($evento->dataFim))}}<br>
                                    {{-- <strong>Submissão:</strong> {{date('d/m/Y',strtotime($evento->inicioSubmissao))}} - {{date('d/m/Y',strtotime($evento->fimSubmissao))}}<br>
                                    <strong>Revisão:</strong> {{date('d/m/Y',strtotime($evento->inicioRevisao))}} - {{date('d/m/Y',strtotime($evento->fimRevisao))}}<br> --}}
                                </p>
                                <p>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-12">
                                            <img src="{{ asset('/img/icons/location_pointer.png') }}" alt="" width="18px" height="auto">
                                            {{$evento->endereco->rua}}, {{$evento->endereco->numero}} - {{$evento->endereco->cidade}} / {{$evento->endereco->uf}}.
                                        </div>
                                    </div>
                                </p>
                                <p>
                                    <a href="{{  route('evento.visualizar',['id'=>$evento->id])  }}" class="visualizarEvento">Visualizar Evento</a>
                                </p>
                            </div>
                        </div>

                    </div>
                    <!-- Modal de exclusão do evento -->
                    <div class="modal fade" id="modalExcluirEvento{{$evento->id}}" tabindex="-1" role="dialog" aria-labelledby="#label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #114048ff; color: white;">
                            <h5 class="modal-title" id="#label">Confirmação</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                                <div class="modal-body">
                                    Tem certeza de deseja excluir esse evento?
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                <button type="submit" class="btn btn-primary" form="formExcluirEvento{{$evento->id}}">Sim</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- fim do modal -->
                @endcan
            @endif
        @endforeach
    </div>

</div>

@endsection
