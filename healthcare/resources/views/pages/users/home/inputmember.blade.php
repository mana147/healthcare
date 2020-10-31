<div class="container">
  <div class="row">
    <div class="col">

        <h3 style="color: rgb(0,123,255);">Nhập tên thành viên muốn thêm : </h3>
        <p> Nhập tên thành viên ... ví dụ : N.Văn Abcd  </p>
        <div class="form-group">
            <label for="usr">Tên thành viên : </label>
            <input type="text" class="form-control mr-2" id="nMember">
        </div>
        <button class="btn btn-primary" onclick="Function_SetIdMember()">Submit</button>

    </div>
    
    <div class="col">

        <h3 style="color: rgb(0,123,255);">Nhập ID thành viên muốn xóa : </h3>
        <p> Nhập ID thành viên ... ví dụ : us00hw00mb00  </p>
        <div class="form-group">
            <label for="usr">ID thành viên : </label>
            <input type="text" class="form-control mr-2" id="idMember">
        </div>
        <button class="btn btn-primary" onclick="Function_RemoveMember()">Submit</button>
    
    </div>
  </div>
</div>