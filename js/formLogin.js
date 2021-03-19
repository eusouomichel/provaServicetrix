/**
 * Script formLogin.js
 * @author Michel Miléski
 * @version 0.1
 */

// Localizamos se existe o formulário para validação
let formToValidate = document.querySelector('.formValidationJs');

// checamos se existe um botão de submit no formulário
if(document.querySelector(`#${formToValidate.id} button[type="submit"]`)) {
    let submitloginForm = document.querySelector(`#${formToValidate.id} button[type="submit"]`);

    // ficamos 'escutando' o evento de click do botão submit
    submitloginForm.addEventListener("click", () => {

        // setamos uma variável de erro como false
        let erro = false;

        // esta função previne que o formulário seja enviado de maneira automática por se tratar de um click on submit
        event.preventDefault();

        // checamos se existe algum input para ser validado
        if(document.querySelectorAll(`#${formToValidate.id} input`)) {

            // pegamos todos os inputs para checagem
            let anyFields = document.querySelectorAll(`#${formToValidate.id} input`);
            anyFields.forEach((field) => {

                // filtramos pela propriedade required
                if(field.required) {

                    // removemos as classes de success e error default do bootstrap
                    field.classList.remove("is-valid");
                    field.classList.remove("is-invalid");

                    // removemos a mensagem de alerta e exibição de erros
                    if(document.querySelector(`[data-error-from="${field.id}"]`)) {
                        document.querySelector(`[data-error-from="${field.id}"]`).remove();
                    }

                    // checa se existe alguma mensagem de erro customizada
                    let mensagem = field.getAttribute("data-error-message");
                    if(field.getAttribute("data-error-message") == null) {
                        mensagem = "Este campo nessecita ser preenchido.";
                    }

                    // checamos inicialmente se o campo esta em branco
                    if(field.value == "") {
                        // seta o erro como true
                        erro = true;

                        // cria uma DIV abaixo do campo e informa o erro
                        field.classList.add("is-invalid");
                        document.querySelector(`#${field.id}`).insertAdjacentHTML("afterend", `<div class='this-error' data-error-from='${field.id}'>${mensagem}</div>`);
                    } else {

                        if(field.type == "email") {
                            // checamos via regex
                            var reg = /^([a-z]){1,}([a-z0-9._-]){1,}([@]){1}([a-z]){2,}([.]){1}([a-z]){2,}([.]?){1}([a-z]?){2,}$/i;
                            if(!reg.test(field.value)) {
                                erro = true;
                                field.classList.add("is-invalid");
                                document.querySelector(`#${field.id}`).insertAdjacentHTML("afterend", `<div class='this-error' data-error-from='${field.id}'>${mensagem}</div>`);
                            }
                        } else if(field.type == "password") {
                            let erroSenha = false;
                            let valor = field.value;

                            // testamos o tamanho mínimo
                            if(valor.length < 6) {
                                erroSenha = true;
                            }

                            // testamos se existe pelo menos 1 letra e 1 número
                            let letras = /[a-z]/; 
                            let numeros = /[0-9]/;
                            let auxLetras = 0;
                            let auxNumeros = 0;

                            // criamos um loop para checar caracter por caracter e procurar por:
                            for(let i=0; i<valor.length; i++){

                                // letras
                                if(letras.test(valor[i])) {
                                    auxLetras++;
                                }

                                // numeros
                                else if(numeros.test(valor[i])) {
                                    auxNumeros++;
                                }
                            }

                            // somente validamos se existe algum erro nestas combinações
                            if(auxLetras == 0 || auxNumeros == 0) {
                                erroSenha = true;
                            }

                            // se existe algum erro nas senhas retornamos erro ao formulário
                            if(erroSenha == true) {
                                erro = true;
                                field.classList.add("is-invalid");
                                document.querySelector(`#${field.id}`).insertAdjacentHTML("afterend", `<div class='this-error' data-error-from='${field.id}'>${mensagem}</div>`);
                            }
                        }
                    }
                }
            });
        }

        // se nao encontrar erro executa o submit do formulário
        if(erro == false) {
            document.querySelector(`#${formToValidate.id}`).submit();
        }

    });
}