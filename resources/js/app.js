
import "./blatui.js";
import html2canvas from "html2canvas-pro";

window.downloadAgmaCard = async function () {
    const card = document.getElementById("agma-member-card");

    if (!card) {
        alert("Member card element not found.");
        return;
    }

    try {
        await document.fonts.ready;

        const canvas = await html2canvas(card, {
            scale: 3,
            backgroundColor: "#172B3A",
            useCORS: true,
        });

        const link = document.createElement("a");
        link.download = "AGMA-Member-ID.png";
        link.href = canvas.toDataURL("image/png");

        document.body.appendChild(link);
        link.click();
        link.remove();

    } catch (error) {
        console.error("AGMA Download Error:", error);
        alert("Download failed: " + error.message);
    }
};
