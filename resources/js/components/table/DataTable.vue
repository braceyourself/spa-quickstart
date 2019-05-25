<template>
    <div class="table">
        <table>
            <thead>
            <tr>
                <th v-for="column_name in columns"
                    @click="sortTable(column_name)">

                    {{column_name}}

                    <div class="arrow"
                         v-if="column_name === sort_column"
                         :class="[ascending ? 'arrow_up' : 'arrow_down']"></div>

                </th>
                <th class="table-button-container" @click="create">
                    Add
                </th>
            </tr>
            </thead>

            <tbody>
            <table-row v-for="row in rows" :key="row.id">

                <table-column v-for="(col,i) in columns" :key="i"
                              :text="row[col]"
                              :editable="editing_row !== null && editing_row.id === row.id && isEditableCol(col)"/>


            </table-row>

            <table-row v-if="creating_row">
                <table-column v-for="(col,i) in columns" :key="i"
                              :editable="isEditableCol(col)"/>
            </table-row>
            </tbody>

        </table>

        <div class="pagination">
            <div class="number"
                 v-for="i in page_count"
                 :class="[i === current_page ? 'active' : '']"
                 @click="selectPage(i)">{{i}}
            </div>
        </div>

    </div>
</template>

<script>
    // import Dialog from '../Dialog';
    export default {
        name: "Table",
        data() {
            return {
                current_page: 1,
                elements_per_page: 3,
                editing_row: null,
                creating_row: false,
                ascending: false,
                sort_column: '',
            }
        },

        methods: {
            isEditableCol(col) {
                let immutable = [
                    '*_id', 'created_at', 'updated_at'
                ];
                let allow = [
                    'client_id'
                ];
                if (_.includes(allow, col)) {
                    return true
                }
                return !_.includes(immutable, col)


            },
            editRow(row) {
                this.cancelEdit();
                this.editing_row = row;
            },
            saveEdit() {
                this.$emit('update', this.editing_row);
                this.cancelEdit();
            },
            cancelEdit() {
                if (this.confirmedCancel())
                    this.editing_row = null;
            },
            confirmedCancel() {

                // Dialog.ask("Are you sure you'd like to cancel?")
                return true;
            },
            create() {
                this.cancelEdit();
                let new_row = this.buildNewRow();
                this.$modal.show('new-data-row',{
                    title: 'testing'
                })


                // this.creating_row = true;
                // this.$emit('created')
            },

            buildNewRow() {
                let obj = {};
                _.forEach(this.columns, (c) => {
                    obj[c] = '';
                });
                return obj;
            },
            sortTable(col) {
                this.cancelEdit();

                if (this.sort_column === col) {
                    this.ascending = !this.ascending;
                } else {
                    this.ascending = true;
                    this.sort_column = col;
                }

                var ascending = this.ascending;

                this.rows.sort(function (a, b) {
                    if (a[col] > b[col]) {
                        return ascending ? 1 : -1
                    } else if (a[col] < b[col]) {
                        return ascending ? -1 : 1
                    }
                    return 0;
                })
            },
            selectPage(page) {
                this.current_page = page;
            }
        },
        computed: {
            page_count() {
                return Math.ceil(this.rows.length / this.elements_per_page);
            },
            rows() {
                var start = (this.current_page - 1) * this.elements_per_page;
                var end = start + this.elements_per_page;
                return this.data.slice(start, end);
            },
            columns() {
                if (this.data.length === 0) {
                    return [];
                }
                return Object.keys(this.data[0])
            }
        },
        props: {
            data: {
                type: Array,
                default: []
            },
        }
    }
</script>

<style scoped lang="scss">

    .table {
        max-width: 100vw;
        overflow: auto;
    }

    table {
        font-family: 'Open Sans', sans-serif;
        border-collapse: collapse;
        border: 3px solid #44475C;
        margin: 10px 10px 0 10px;

        th {
            text-transform: uppercase;
            text-align: left;
            background: #44475C;
            color: #FFF;
            cursor: pointer;
            padding: 8px;
            min-width: 30px;


            &.table-button-container {
                text-transform: lowercase;
                text-align: right;
            }

            &:hover {
                background: #717699;

                &.table-button-container {
                    /*background: ;*/
                }
            }
        }


        td {
            text-align: left;
            padding: 8px;
            border-right: 2px solid #7D82A8;

            &:last-child {
                border-right: none;
            }
        }

        tbody {
            tr:nth-child(2n) td {
                background: #D4D8F9;
            }
        }


    }


    .pagination {
        font-family: 'Open Sans', sans-serif;
        text-align: right;
        width: 750px;
        padding: 8px;
    }

    .arrow_down {
        background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAaCAYAAABPY4eKAAAAAXNSR0IArs4c6QAAAvlJREFUSA29Vk1PGlEUHQaiiewslpUJiyYs2yb9AyRuJGm7c0VJoFXSX9A0sSZN04ULF12YEBQDhMCuSZOm1FhTiLY2Rky0QPlQBLRUsICoIN/0PCsGyox26NC3eTNn3r3n3TvnvvsE1PkwGo3yUqkkEQqFgw2Mz7lWqwng7ztN06mxsTEv8U0Aam5u7r5EInkplUol/f391wAJCc7nEAgE9Uwmkzo4OPiJMa1Wq6cFs7Ozt0H6RqlUDmJXfPIx+qrX69Ti4mIyHA5r6Wq1egND+j+IyW6QAUoul18XiUTDNHaSyGazKcZtdgk8wqhUKh9o/OMvsVgsfHJy0iWqVrcQNRUMBnd6enqc9MjISAmRP3e73T9al3XnbWNjIw2+KY1Gc3imsNHR0YV4PP5+d3e32h3K316TySQFoX2WyWR2glzIO5fLTSD6IElLNwbqnFpbWyO/96lCoai0cZjN5kfYQAYi5H34fL6cxWIZbya9iJyAhULBHAqFVlMpfsV/fHxMeb3er+Vy+VUzeduzwWC45XA4dlD/vEXvdDrj8DvURsYEWK3WF4FA4JQP9mg0WrHZbEYmnpa0NxYgPVObm5teiLABdTQT8a6vrwdRWhOcHMzMzCiXlpb2/yV6qDttMpkeshEzRk4Wo/bfoe4X9vb2amzGl+HoXNT29vZqsVi0sK1jJScG+Xx+HGkL4Tew2TPi5zUdQQt9otPpuBk3e0TaHmMDh1zS7/f780S0zX6Yni+NnBj09fUZUfvudDrNZN+GkQbl8Xi8RLRtHzsB9Hr9nfn5+SjSeWUCXC7XPq5kw53wsNogjZNohYXL2EljstvtrAL70/mVaW8Y4OidRO1/gwgbUMvcqGmcDc9aPvD1gnTeQ+0nmaInokRj0nHh+uvIiVOtVvt2a2vLv7Ky0tL3cRTXIcpPAwMDpq6R4/JXE4vFQ5FI5CN+QTaRSFCYc8vLy1l0rge4ARe5kJ/d27kYkLXoy2Jo4C7K8CZOsEBvb+9rlUp1xNXPL7v3IDwxvPD6AAAAAElFTkSuQmCC')
    }

    .arrow_up {
        background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAaCAYAAACgoey0AAAAAXNSR0IArs4c6QAAAwpJREFUSA21Vt1PUmEYP4dvkQ8JFMwtBRocWAkDbiqXrUWXzU1rrTt0bdVqXbb1tbW16C9IBUSmm27cODdneoXjputa6069qwuW6IIBIdLvdaF4OAcOiGeDc87zPs/vd57P96WpFq7p6enbGo1mjKZpeTabjU1MTCRagGnOZHFxcXxtbe1XKpUq7+zslJeXl//Mz8+Hy+Uy3RxSE9qTk5M3otFooVQqgef4Wl9f343FYoEmoISrxuNxFX5f9vb2jhn/PxUKhfLS0tIPfFifUESRUMV8Pv/M6XReRm5rTGQyGeXxeGxYe1ezeBpBOBx2rKysbO7v79d4Wy3Y2Nj4GQqFbgnhaugxwiuGJx99Pp9FLBbXxYTXvTqd7v3MzIy6riIWGxJnMpl7AwMD14xGYyMsSq1WUyQdUqn0eSPlusQIsbGrq+vl4OCgvhFQZd1utyv1en0gEolcqsi47nWJlUrlG5fLZVcoFFy2nDKSDpIWlUoVTCQSEk4lCHmJMZ2GTCbTiMVikfIZ88l7enoos9l8dXt7+z6fDicxSJUokqDX6xXcl2wCROoc0vQCWL3sNfLOSdzR0fHY4XC4tVotl40gmVwup9xuN4OQv+UyqCFGH9rg7SOGYVRcBs3IEG4J0nVnamrqOtvuBDGGgQg9+wHFcVEi4a0LNkbdd6TrPKo8ODc311mteIIYjT/a398/jK+s1jnVM0kXoufCFvq0GuiIGEVgQIhfoygM1QrteEa9dAL7ITiYCt4RMabOK5AyKKzKWtvupLcRciu8D5J0EuDDPyT/Snd39yh6VtY2NhYQSR9G79Ds7OxdskRjEyAufvb7/cPoO5Z6e1+xtVKrq6vfcFzyi/A3ZrPZ3GdNSlwgo5ekE4X2RIQGf2C1WlufFE0GBeGWYQ8YERWLxQtnUVB830MKLZfL9RHir8lkssCn2G751tZWEWe03zTKm15YWPiEiXXTYDB0Ig/t7yd8PRws4EicwWHxO4jHD8/C5HiTTqd1BwcHFozKU89origB+y/kmzgYpgOBQP4fGmUiZmJ+WNgAAAAASUVORK5CYII=')
    }

    .arrow {
        float: right;
        width: 12px;
        height: 15px;
        background-repeat: no-repeat;
        background-size: contain;
        background-position-y: bottom;
    }


    .number {
        display: inline-block;
        padding: 4px 10px;
        color: #FFF;
        border-radius: 4px;
        background: #44475C;
        margin: 0px 5px;
        cursor: pointer;

        &:hover, &.active {
            background: #717699;
        }
    }

    .table-button-container {
        button {
            display: block;
            width: 100%;
            padding: 4px 10px;
            color: #FFF;
            border-radius: 4px;
            background: #44475C;
            margin: 5px 0px;
            cursor: pointer;

            &:hover, &.active {
                background: #717699;
            }
        }

    }


</style>
