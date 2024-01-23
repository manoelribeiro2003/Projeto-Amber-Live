document.addEventListener('DOMContentLoaded', function() {
    // Obtém referências aos elementos do DOM
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    // Adiciona um ouvinte de evento de input para a barra de pesquisa
    searchInput.addEventListener('input', handleSearchInput);

    // Função para lidar com a entrada na barra de pesquisa
    function handleSearchInput() {
        const searchTerm = searchInput.value.toLowerCase();

        // Simula uma busca em um conjunto de dados
        const fakeData = ['Apple', 'Banana', 'Orange', 'Grapes', 'Pineapple', 'Strawberry'];
        const filteredResults = fakeData.filter(item => item.toLowerCase().includes(searchTerm));

        // Exibe os resultados na lista
        displayResults(filteredResults);
    }

    // Função para exibir os resultados na lista
    function displayResults(results) {
        // Limpa a lista de resultados
        searchResults.innerHTML = '';

        // Adiciona os resultados à lista
        results.forEach(result => {
            const listItem = document.createElement('li');
            listItem.textContent = result;
            searchResults.appendChild(listItem);
        });
    }
});