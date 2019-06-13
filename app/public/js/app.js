var deleteModal = $('#deleteModal');



function deleteMsg(blog, id){
    $(this).click(function(event){
        event.preventDefault();
    });

    deleteModal.modal('show');
    $('.modal-body').text(blog);
    $('.modal-footer .btn-danger').attr("id",id);
}

$('.modal-footer .btn-danger ').on("click",(ev)=>{
    let id= $(ev.target).attr("id");
    window.location.href="/delete-post/"+id;
});
