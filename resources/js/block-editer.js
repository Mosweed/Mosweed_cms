document.addEventListener('DOMContentLoaded', function() {
    const sortableList = document.getElementById('sortable-list');
    const dropPlaceholder = document.getElementById('drop-placeholder');
    const draggableItems = document.querySelectorAll('[drag-item]');



    new Sortable(dropPlaceholder, {
        animation: 100,
        onUpdate: function(event) {

            let items = Array.from(dropPlaceholder.children).map((item, index) =>{
            return {index: index, oldindex : item.dataset.block }
            }
        );
            console.log(items);

         Livewire.dispatch('reoderactiveblocks', {orders: items});
     },
    });


    draggableItems.forEach(function(item) {
        item.addEventListener('dragstart', function(event) {
          event.dataTransfer.setData('text/plain', this.dataset.block);
            event.target.setAttribute('inserting', true);

        });

        item.addEventListener('dragend', function(event) {
            event.target.removeAttribute('inserting');
        });
    });

    dropPlaceholder.addEventListener('dragover', function(event) {

        event.preventDefault();
    });

    dropPlaceholder.addEventListener('drop', function(event) {
        event.preventDefault();

        const dropZone = event.target;
        const clientRect = dropZone.getBoundingClientRect();
        const dropPosition = event.clientY - clientRect.top < clientRect.height / 2 ? 'before' : 'after';
        const droppedOn = event.target.closest('[drag-pl-item]');
        const items = Array.from(dropPlaceholder.children);
        const targetIndex = items.indexOf(droppedOn);

        const insertingEl = document.querySelector('[inserting]');

        if (!insertingEl) return;

        let id = insertingEl.dataset.block;
        if (dropPosition === 'before') {
            console.log('before');
                Livewire.dispatch('insertBlock',{id:id  , index:targetIndex , placement: dropPosition});

        } else {

            Livewire.dispatch('insertBlock',{id:id  , index:targetIndex , placement: dropPosition});

        }
    });

    dropPlaceholder.addEventListener('click', function(event) {
    const itemClicked = event.target.closest('[drag-pl-item]');
    if (!itemClicked) return;

    const items = Array.from(dropPlaceholder.children);
    const clickedIndex = items.indexOf(itemClicked);

    Livewire.dispatch('blockEditComponentSelected', {
                    blockId: clickedIndex
                });
});


});
