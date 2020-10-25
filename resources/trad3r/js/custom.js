function thanx()
{
    let form = $(this).closest('form');
    $('#thanx').show();
    form.submit();
}