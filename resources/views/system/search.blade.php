<form action="{{route('system.adminController.search')}}" method="POST" class="form-search">
    @method('GET')
<div class="form-group">
	<div >
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-9">
                    <input type="text" class="form-control" name="nome" value="{{old('nome')}}" placeholder="Nome da Linguagem" >
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                    <input type="date" class="form-control" name="data" value="{{old('data')}}" placeholder="data de atualização" >
          </div>
                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    </span>
                    </div>
          </div>
</form>
