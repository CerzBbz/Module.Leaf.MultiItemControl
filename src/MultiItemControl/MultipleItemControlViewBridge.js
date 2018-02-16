var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.ViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.ViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
    var self = this,
        getElements = function (className) {
            var nodeList = self.viewNode.getElementsByClassName(className);
            nodeList.forEach = Array.prototype.forEach;
            return nodeList;
        },
        deleteEventHandler = function () {
            var div = this.parentNode;
            if (confirm("Are you sure you would like to delete this entry?")) {
                div.parentNode.removeChild(div)
            }
        },
        deleteButtons = getElements('js-delete'),
        addButtons = getElements('js-add'),
        itemContainer = getElements('js-items-container')[0];

    deleteButtons.forEach(function (deleteButton) {
        deleteButton.addEventListener('click', deleteEventHandler);
    });

    addButtons.forEach(function (addButton) {
        addButton.addEventListener('click', function () {
            var leafPath = self.model.leafPath;

            var item = document.createElement('div');
            item.classList.add('u-marg-bottom');
            itemContainer.appendChild(item);

            self.model.columns.forEach(function (column) {
                var columnLabel = document.createElement('label');
                columnLabel.classList.add('c-label');
                columnLabel.setAttribute('for', column);
                columnLabel.innerHTML = column + ': ';

                var columnInput = document.createElement('input');
                columnInput.type = 'text';
                columnInput.name = leafPath + '[' + column + '][]';

                item.appendChild(columnLabel);
                item.appendChild(columnInput);
            });

            var deleteButton = document.createElement('button');
            deleteButton.classList.add('js-delete');
            deleteButton.type = 'button';
            deleteButton.addEventListener('click', deleteEventHandler);
            deleteButton.innerHTML = 'x';
            item.appendChild(deleteButton);
        });
    });
};

window.rhubarb.viewBridgeClasses.MultipleItemControlViewBridge = bridge;