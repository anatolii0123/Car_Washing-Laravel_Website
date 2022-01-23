<label for="start_time">Vehicle Make model</label>
<select class="form-control mb-1" id="icon" name="model_id">
    @foreach ($location_mark_models as $model)
        <option value={{ $model->id }} >{{ $model->model }}</option>
    @endforeach
</select>