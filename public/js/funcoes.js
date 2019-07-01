//Botoes de mudanca de página na listagem por paginação
$(document).ready(function () {
$('.page-item').on('click', function (e) {
        e.preventDefault();
        var npage = $(this).attr("value");
        var ultpg = $(this).attr("ultpg");
        var prodPorPagCat = $(this).attr("prodPorPagCat");
        $.ajax({
            type: 'POST',
            url: '/pageProd',
            data: {npage : npage,
            ultpg : ultpg,
            prodPorPagCat : prodPorPagCat
            },
           
            
            success: function (data) {
                if(data == 'primeira' || data=='ultima'){
                    return null;
                }
               $('#retorno').html(data);
            }
            
            
            
        });
    });
});

//Botão de fazer pergunta /página de produto
$(document).ready(function () {
$('.form-pergunta').on('submit', function (e) {
        e.preventDefault();
        
        var formdata = new FormData(this);
        
        //alert();
        $.ajax({
            type: 'POST',
            url: '/perguntar',
            data: formdata,
           
            
            success: function (data) {
                
               $('#retorno').html(data);

            },
            cache: false,
            contentType: false,
            processData: false
            
            
            
        });
    });
});

//Botão de editar /meus anuncios
//$(document).ready(function () {
//$('.btnEditProd').on('click', function (e) {
//        e.preventDefault();
//        
//        var idProd = $(this).attr("value");
//        
//        
//        
//        $.ajax({
//            type: 'POST',
//            url: '/telaEditarProduto',
//            data: {idProd: idProd},
//           
//            
//            success: function (data) {
//                document.write(data);
//               
//
//            }
//          
//            
//            
//            
//        });
//    });
//});

//Visualização de imagem na página de cadastrar produto
$(document).ready(function () {
$('#img').on('change', function (e) {
        //e.preventDefault();
        
       var file = $('#img').prop('files')[0];
       
       var formdata = new FormData();
        formdata.append('arquivo', file);
       
        $.ajax({
            type: 'POST',
            url: '/trocarimg',
            data: formdata,
            
            success: function (data) {
                $('#retornoimg').html(data);
            },
            cache: false,
            contentType: false,
            processData: false
            
            
        });
    });
});

//Exibir div de exclusao
$(document).ready(function () {
$('.btnExcluirProd').on('click', function (e) {
        e.preventDefault();
        
        var idProd = $(this).attr("value");
        
        
        
        $.ajax({
            type: 'POST',
            url: '/exibirDiv',
            data: {idProd: idProd},
           
            
            success: function (data) {
                $("#retornoExcl").html(data);
               

            }
          
            
            
            
        });
    });
});

//Formulário de login
$(document).ready(function () {
    $('#formLogin').on('submit', function (e) {

        e.preventDefault(); // evita que o formulário seja submetido
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $('#formLogin').attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function (data) {
                if (data == 'logado')
                    window.location = '/';
                else
                    $("#erroLogin").html(data);
            },
            error: function () {
                $("#div_retorno").html("Erro em chamar a função.");
                setTimeout(function () {
                    $("#div_retorno").css({display: "none"});
                }, 5000);
            }
        });
    });
});

//Formulário de cadastro
$(document).ready(function () {
    $('#formCadastro').on('submit', function (e) {

        e.preventDefault(); // evita que o formulário seja submetido
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $('#formCadastro').attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function (data) {
                //alert(data);    
                if (data == 'logadocadastrado') {
                    window.location = '/';
                } else
                    alert(data)
                    
                //$("#div_retorno").html(data);
            },
            error: function () {
                $("#div_retorno").html("Erro em chamar a função.");
                setTimeout(function () {
                    $("#div_retorno").css({display: "none"});
                }, 5000);
            }
        });
    });
});

//Formulario de alteracao de dados
$(document).ready(function () {
    $('#formAlterarDados').on('submit', function (e) {
        
        e.preventDefault(); // evita que o formulário seja submetido
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '/alterarDados',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function (data) {
                 
                if (data === 'Alterado') {
                    alert(data);
                    window.location = '/meusDados';
                } else
                    alert(data);
                    
                //$("#div_retorno").html(data);
            },
            error: function () {
                $("#div_retorno").html("Erro em chamar a função.");
                setTimeout(function () {
                    $("#div_retorno").css({display: "none"});
                }, 5000);
            }
        });
    });
});

//Formulário de cadastro de produto
$(document).ready(function () {
    $('#formCadProd').on('submit', function (e) {
        
        e.preventDefault(); // evita que o formulário seja submetido
        var formData = new FormData(this);
        
        
        $.ajax({
            type: 'POST',
            url: '/cadastrarProduto',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function (data) {
                  
                window.location = '/';
                    
               
            },
            error: function () {
                $("#div_retorno").html("Erro em chamar a função.");
                setTimeout(function () {
                    $("#div_retorno").css({display: "none"});
                }, 5000);
            }
        });
    });
});
//Formulário de edição de produto
$(document).ready(function () {
    $('#formEditProd').on('submit', function (e) {
       
        e.preventDefault(); // evita que o formulário seja submetido
        var formData = new FormData(this);
        
        var idProd = $('#btnSalvarAlt').attr('idProd');
        formData.append('idProd', idProd);
        //alert(idProd);
      
        $.ajax({
            type: 'POST',
            url: '/alterarProduto',
            data: formData,idProd,
            cache: false,
            contentType: false,
            processData: false,

            success: function (data) {
                
                alert(data);
               window.location='/meusAnuncios';
            },
            error: function () {
                $("#div_retorno").html("Erro em chamar a função.");
                setTimeout(function () {
                    $("#div_retorno").css({display: "none"});
                }, 5000);
            }
        });
    });
});

//
////Pesquisar produto
//$(document).ready(function () {
//    $('#formSearch').on('submit', function (e) {
//       
//        e.preventDefault(); // evita que o formulário seja submetido
//        var formData = new FormData(this);
//         
//          var nomeProd = $("#inputSearch").val();
//          
//         
//        $.ajax({
//            type: 'POST',
//            url: '/pesquisarProdutosPorNome/'+nomeProd,
//            data: formData,
//            cache: false,
//            contentType: false,
//            processData: false,
//
//            success: function (data) {
//                if(data==""){
//                    alert("Digite algo!");
//                    return;
//                }
//                window.location="/pesquisarProdutosPorNome/"+data;
//              
//                    
//               
//            },
//            error: function () {
//                $("#div_retorno").html("Erro em chamar a função.");
//                setTimeout(function () {
//                    $("#div_retorno").css({display: "none"});
//                }, 5000);
//            }
//        });
//    });
//});

function pesquisarProduto(){
    var nomeProd = $("#inputSearch").val();
    if(nomeProd==""){
        alert("Digite algo!");
        return;
    }
    window.location='/pesquisarProdutosPorNome/'+nomeProd;
}

function mostrarMenuHamburg() {
    var x = document.getElementById("listaNavBar");

    if (x.style.display === "none") {
        x.style.display = "block";
       
    } else {
        x.style.display = "none";
      
      
    }
}

$("#inputSearch").on('keyup', function (e) {
    if (e.keyCode === 13) {//evento do botão enter
        pesquisarProduto();
    }
});

//Modal

$("#altSenha").on('click', function (e) {
    e.preventDefault();
  
  var modal = document.getElementById("myModal");
  
  var span = document.getElementsByClassName("close")[0];
  
  modal.style.display = "block";
  
  span.onclick = function() {
  modal.style.display = "none";
  };
  
  window.onclick = function(event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
};
  
});

$("#btn_altSenha").on('click', function (e) {
    var senha = $("#senha").val();
    var csenha = $("#csenha").val();
    
    if (senha!==csenha){
        alert("Senhas diferentes");
        return;
    }else{
        $.ajax({
            type: 'POST',
            url: '/altSenha',
            data: {senha : senha},

            success: function (data) {
                if (data === 'Alterado') {
                    alert(data);
                    window.location = '/meusDados';
                } else{
                    alert(data);
                }
            }
            
            
        });
    }
    
});

$("#btn_Negociar").on('click', function (e) {
    var divVendedor = document.getElementById("vendedor");
    if (divVendedor.style.display === "none") {
        divVendedor.style.display = "block";
       
    }
});

$("#btn_envEmail").on('click', function (e) {
    var textArea = $("#textAreaProd").val();
    var email = $("#textAreaProd").attr("emailVend");
    $.ajax({
            type: 'POST',
            url: '/envEmail',
            data: {email : email, textArea: textArea},

            success: function (data) {
               $("#retorno_email").html(data);
            }
            
            
        });
});
