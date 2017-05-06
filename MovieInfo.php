<body>
    <section id="secMovieInfo" style="background-color: silver;">
        <h2><input id="txtTitle" type="text" readonly="readonly" style="background-color: silver; border: none;"></h2>
        <p>Studio: <input id="txtStudio" type="text" readonly="readonly" style="background-color: silver; border: none;"></p>
        <p>Release Year: <input id="txtYear" type="text" readonly="readonly" style="background-color: silver; border: none;"></p>
        <p>Running Time: <input id="txtTime" type="text" readonly="readonly" style="background-color: silver; border: none;"></p>
        <p>Location(s):</p>
        <ul id="lLocation"></ul>
    </section>
    <section>
        <table>
            <thead>Cast Member(s):</thead>
            <tbody id="tbyCast"></tbody>
        </table>

        <table>
            <thead>Director(s):</thead>
            <tbody id="tbyDirector"></tbody>
        </table>
        
        <table>
            <thead>Producer(s):</thead>
            <tbody id="tbyProducer"></tbody>
        </table>
    </section>
</body>