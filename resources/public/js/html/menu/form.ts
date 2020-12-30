//@ts-ignore
//@ts-nocheck
$(() => {
    window.actionInsert = resp => {
        resp = $(resp);
        const message = resp.has(".alert-message")
            ? resp.text()
            : resp.find(".alert-message").text();
        if (message.toLowerCase().match("success")) window.nextReload = true;
    };
    window.menuFormInit = () => {
        const updateForm = $("#update-form");
        window.rdd =
            // build lại form
            updateForm.find('select[name="chucnangid"]').autoCompleteSelect({
                renderData: option =>$(`<div class="py-1 px-3">
                <div>${option.innerText}</div>
                <div><span style="font-weight: 700">URL: </span>${option.getAttribute("url")}</div>
            </div>`)
            });
        updateForm.show();
        const id = $("#form-region").data("parent-id");
        updateForm.attr("ajax-form", "actionInsert");
        if (id !== "")
            updateForm.append(
                $(`<input name="idcha" type="hidden" value="${id}">`)
            );
        layoutAction.rebuild.autoFormEvent(updateForm.parent());
        layoutAction.rebuild.autoBmd(updateForm);

        // validation
        // updateForm.validateCustom({

        // })
    };
    window.menuFormInit();
});
