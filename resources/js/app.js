import "./bootstrap";

document.querySelectorAll("form[data-accept-quest]").forEach((form) => {
    form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const response = await fetch(form.action, {
            method: "POST",
            body: new FormData(form),
        });

        if (!response.ok) {
            form.submit();
            return;
        }

        form.outerHTML = "<p>✅ Vous avez accepté cette quête.</p>";
    });
});
