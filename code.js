const fetch = require('node-fetch');

const getSteamInventory = async (apiKey, steamId) => {
    const url = `https://api.steampowered.com/IEconItems_730/GetPlayerItems/v1/?key=${apiKey}&steamid=${steamId}`;
    
    try {
        const response = await fetch(url);
        
        if (!response.ok) {
            throw new Error(`Ошибка при получении данных: ${response.statusText}`);
        }
        
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Ошибка:', error);
        return null;
    }
};

// Ваш API ключ и Steam ID игрока
const apiKey = "17EA696C4E9C2C11E16BDED1FFC2AC71";
const steamId = "76561198850279302";

getSteamInventory(apiKey, steamId)
    .then(inventory => {
        if (inventory) {
            console.log(inventory);
        } else {
            console.log("Не удалось получить инвентарь.");
        }
    });
