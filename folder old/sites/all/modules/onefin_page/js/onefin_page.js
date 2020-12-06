$(document).ready(function()
    {
        $('table.table-refresh').tablesorter();
    }
);

function productOpenCollapse(context) {

    $this = $(context);
    var taxonomytable = $(context).prev('table');
    if($this.text() === 'See more') {
        $this.find('span').text("See less").button('refresh');
        $this.find('i').removeClass('fa-plus');
        $this.find('i').addClass('fa-minus');

    } else if($this.text() === 'See less') {
        $this.find('span').text("See more").button('refresh');
        $this.find('i').removeClass('fa-minus');
        $this.find('i').addClass('fa-plus');
    }
    taxonomytable.each(function () {
        $("tr:gt(6)", this).toggleClass('hide');
        $('html,body').animate({scrollTop: taxonomytable.offset().top},500,'linear');
    });
}