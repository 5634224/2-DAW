    {foreach from=$productos item=producto}
        <p><form id='{$producto->getcodigo()}' action='productos.php' method='post'>
        <input type='hidden' name='cod' value='{$producto->getcodigo()}'/>
        <input type='submit' name='enviar' value='Añadir'/>
        {$producto->getnombrecorto()}: {$producto->getPVP()} euros.</form></p>
    {/foreach}
