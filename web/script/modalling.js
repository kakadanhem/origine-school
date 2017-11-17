$(function () {
    $('.create-guardian-modal-click').click(function () {
        $('#create-guardian-modal')
            .modal('show')
            .find('#createGuardianModalContent')
            .load($(this).attr('value'));
    });
});

$(function () {
    $('.create-group-modal-click').click(function () {
        $('#create-group-modal')
            .modal('show')
            .find('#createGuardianModalContent')
            .load($(this).attr('value'));
    });
});