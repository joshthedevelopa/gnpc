function get_parent(child, selector) {
  let parent = child;
  let elems = document.querySelectorAll(selector);

  while (parent != null) {
    parent = parent.parentElement;

    for (let i = 0; i < elems.length; i++) {
      var elem = elems[i];
      if(parent == elem) {
        return parent;
      }
    }
  }


  return null
}

function validated_form(validator_wrapper) {
  console.log("Validating.... ");

  let error = false;
  let inputs;

  if(validator_wrapper.classList.contains('validator')) {
    inputs = validator_wrapper.querySelectorAll("input, select, textarea"); 
  } else {
    inputs = validator_wrapper.getElementsByClassName("validator");
  }

  for(let i = 0; i < inputs.length; i++) {
    let input = inputs[i];

    if(input.dataset.skip == "false" || input.dataset.skip == undefined) {
        let type = input.dataset.type ?? input.getAttribute("type");
        let value = input.value ?? "";
        
        let error_str = '';
        let regex_str = '';
    
        switch (type) {
          case "bank-number":
              regex_str = String.raw`[a-zA-Z0-9-]{13}`;
              error_str = "Bank Account Number should be 13 digits in length";
            break;
          
          case 'password':
              regex_str = String.raw`^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[~!@#$%^&*\(\)_\-+=:;'"\\|\/.,<>?\[\]\{\`\}])[A-Za-z\d~!@#$%^&*\(\)_\-+=:;'"\\|\/.,<>?\[\]\{\`\}]{8,}$`;
              error_str = "Password should be minimum of eight characters, at least one uppercase letter, one lowercase letter, one number and one special character."
            break;
          
          case 'email':
              regex_str = String.raw`^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$`;
              error_str = "Invalid email. eg. example@email.com";
            break;
    
          case 'match':
              const match_elem = document.querySelector(input.dataset.target);
              if(match_elem != null) {
                if(value == match_elem.value) {
                  continue
                }
                
                regex_str = String.raw`^(${match_elem.value})$`;
              }
              error_str = "Value mismatch"
            break;
        
          default:
              regex_str = String.raw`\S+`;
              error_str = "This field is required";
            break;
        }

        let depends = input.dataset.depends;
        let trigger = input.dataset.trigger;

        if(depends != null && trigger != null) {
          let depends_elem = document.querySelector(`*[name="${depends}"]`);

          if(trigger != depends_elem.value) {
            continue
          }
        }

        
        let regex = new RegExp(regex_str);
        if(regex.test(value) && !(input.dataset.defaults ?? "").includes(value)) {
          continue;
        }
        
        let error_display = input.dataset.error ?? `#${input.getAttribute("id")}-error`;
        let error_elem = document.querySelector(error_display);
    
        if(error_elem == null || error_elem == undefined) {
          error_elem = document.createElement("p");
    
          error_elem.classList.add("text-danger", "m-2", "col-12");
          error_elem.setAttribute("id", input.getAttribute("id") + "-error");
    
          input.parentElement.appendChild(error_elem);
        }
    
        error_elem.innerHTML = error_str
        error = true;
      }
    }
    

  return !error;
}

function input_toggle() {
  var triggers = document.getElementsByClassName('toggle-trigger');

  for (let index = 0; index < triggers.length; index++) {

    triggers[index].addEventListener('change', function (event) {
      const trigger = triggers[index];
      const trigger_value = trigger.getAttribute('data-value') ?? trigger.getAttribute('value') ?? trigger.options[trigger.selectedIndex].value;

      var targets = document.getElementsByClassName(`toggle-target ${trigger.dataset.group}`);
      for (let index = 0; index < targets.length; index++) {
        const target = targets[index];
        const target_lookup = target.dataset.lookup;

        if(target_lookup != undefined && target_lookup != null) {
          if(target_lookup == trigger_value) {
            target.setAttribute("data-value", "show");
            continue;
          }
        } else if (target.dataset.default != trigger_value) {
          target.setAttribute("data-value", "show");
          continue;
        }

        target.setAttribute("data-value", "hide");
      }
    });
  }
}

function tab_panel_toggle() {
  var tab_btns = document.querySelectorAll(".tab-pane .tab-pane-btn");

  for (let index = 0; index < tab_btns.length; index++) {
    const tab_btn = tab_btns[index];
    
    tab_btn.addEventListener('click', function (event) {
      var tab = document.querySelector(".nav-link[href='" + tab_btn.dataset.tab + "']");

      if(validated_form(get_parent(tab_btn, ".tab-pane"))) {
        tab = new bootstrap.Tab(tab);
        tab.show();
      }
    })
  }
}

function file_input_action() {
  var inputs = document.getElementsByClassName("custom-file-input");

  for (let index = 0; index < inputs.length; index++) {
    const input = inputs[index];

    input.addEventListener('change', function (event) {
      var file_name = this.value.split('\\').pop();
      if (file_name) {
        var label = document.querySelector("label.custom-file-label[for='" + this.id + "']");
        label.innerHTML = file_name;
      }
    })
    
  }
}


window.onload = function () {
  // Show and Hide follow up inputs based on another inputs action
  input_toggle();

  // Toogle between tab panes - additional functionality to boostrap tabs
  tab_panel_toggle();

  // Updating the file input label
  file_input_action();

  // Validate form elements
  const forms = document.getElementsByTagName("form");
  for (let i = 0; i < forms.length; i++) {
    const form = forms[i];

    form.addEventListener("submit", (event) => {
      if(!validated_form(form)) {
        event.preventDefault();
      }
    })
  }

  const inputs = document.querySelectorAll("select, input, textarea");
  for (let i = 0; i < inputs.length; i++) {
    let input = inputs[i];
    
    input.addEventListener("change", (event) => {
      let error_elem = document.querySelector(input.dataset.error ?? `#${input.getAttribute("id")}-error`);
      if(error_elem) error_elem.innerHTML = "";
    })
  }

  const obscure_trigger = document.querySelectorAll('*[role="obscure-input"]');
  for (let i = 0; i < obscure_trigger.length; i++) {
    let elem = obscure_trigger[i];
    let input = document.querySelector(elem.dataset.target);
    
    if(input != null) {
      elem.addEventListener("click", (event) => {
        if(input.dataset.show == "true") {
          input.dataset.show = "false";
          input.setAttribute("type", "password");
          elem.children[0].classList.remove("fa-eye-slash");
          elem.children[0].classList.add("fa-eye");
        } else {
          input.dataset.show = "true";
          input.setAttribute("type", "text");
          elem.children[0].classList.remove("fa-eye");
          elem.children[0].classList.add("fa-eye-slash");
        }
      })
    }
  }
}