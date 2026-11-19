
import "./blatui.js";
import { toPng } from "html-to-image";

window.downloadAgmaCard = async function () {
    const card = document.getElementById("agma-member-card");

    if (!card) {
        alert("Member card element not found.");
        return;
    }

    try {
        await document.fonts.ready;

        await new Promise(resolve =>
            requestAnimationFrame(() =>
                requestAnimationFrame(resolve)
            )
        );

        // Get the actual card dimensions.
        const rect = card.getBoundingClientRect();

        const width = Math.ceil(rect.width);
        const height = Math.ceil(card.scrollHeight);

        // Capture the complete card.
        const dataUrl = await toPng(card, {
            pixelRatio: 3,
            backgroundColor: "#172B3A",
            cacheBust: true,
            width,
            height,
            style: {
                position: "relative",
                left: "0",
                top: "0",
                margin: "0",
                transform: "none",
                width: `${width}px`,
                height: `${height}px`,
                maxWidth: "none",
                maxHeight: "none",
                overflow: "visible",
                backgroundColor: "#172B3A"
            }
        });

        // Download PNG.
        const link = document.createElement("a");
        link.download = "AGMA-Member-ID.png";
        link.href = dataUrl;

        document.body.appendChild(link);
        link.click();
        link.remove();

    } catch (error) {
        console.error("AGMA Card Download Error:", error);
        alert("Download failed: " + error.message);
    }
};
